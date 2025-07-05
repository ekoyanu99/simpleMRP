<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesDet;
use App\Http\Requests\StoreSalesDetRequest;
use App\Http\Requests\UpdateSalesDetRequest;
use App\Jobs\RunMrpJob;
use App\Models\ItemMstr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SalesDetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesDetRequest $request)
    {
        //
        try {
            $id = Auth::user()->id;

            $total = $request->sales_det_qty * $request->sales_det_price;

            $salesDet = SalesDet::create([
                'sales_det_mstr' => $request->sales_det_mstr,
                'sales_det_date' => $request->sales_det_date,
                'sales_det_duedate' => $request->sales_det_duedate,
                'sales_det_item' => $request->sales_det_item,
                'sales_det_desc' => $request->sales_det_desc,
                'sales_det_qty' => $request->sales_det_qty,
                'sales_det_price' => $request->sales_det_price,
                'sales_det_total' => $total,
                'sales_det_cb' => $id
            ]);

            if ($this->rowInserted($request->sales_det_mstr, $salesDet->sales_det_id)) {
                // trigger RunMrpJob
                RunMrpJob::dispatch();

                $dataMster = SalesDet::where('sales_det_id', $salesDet->sales_det_id)
                    ->with('salesMstr')
                    ->firstOrFail();
                $order = $dataMster->salesMstr;

                $n8nWebhookUrl = env('N8N2_URL');

                Http::withoutVerifying()->post($n8nWebhookUrl, [
                    'sales_mstr_nbr' => $order->sales_mstr_nbr,
                    'sales_mstr_bill' => $order->sales_mstr_bill,
                    'sales_mstr_date' => $order->sales_mstr_date,
                    'sales_mstr_total' => number_format($order->sales_mstr_total, 0, ',', '.'),
                ]);

                // hit calculateAndNotify Mrp mrpMstrController
                $mrpMstrController = new MrpMstrController();
                $mrpMstrController->calculateAndNotify();
                // end hit calculateAndNotify Mrp mrpMstrController

                return redirect()->back()->with('status', 'success');
            } else {
                return redirect()->back()->with('status', 'error');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesDet $salesDet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesDet $salesDet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesDetRequest $request, $salesDetUuid)
    {
        //
        $salesDet = SalesDet::where('sales_det_uuid', $salesDetUuid)->firstOrFail();
        $id = Auth::user()->id;
        // dd($salesDet);

        $total = $request->efid_Price * $request->efid_Qty;

        // dump($request->efid_Qty);
        // dump($request->efid_Price);
        // dd($total);

        $data = [
            'sales_det_date' => $request->efid_Date ?? $salesDet->sales_det_date,
            'sales_det_duedate' => $request->efid_Due ?? $salesDet->sales_det_duedate,
            'sales_det_qty' => $request->efid_Qty ?? $salesDet->sales_det_qty,
            'sales_det_price' => $request->efid_Price ?? $salesDet->sales_det_price,
            'sales_det_total' => $total,
        ];

        if ($salesDet->update($data)) {
            $this->rowInserted($salesDet->sales_det_mstr, $salesDet->sales_det_id);
            RunMrpJob::dispatch();

            $dataMster = SalesDet::where('sales_det_id', $salesDet->sales_det_id)
                ->with('salesMstr')
                ->firstOrFail();
            $order = $dataMster->salesMstr;

            $n8nWebhookUrl = 'https://yanuarso.app.n8n.cloud/webhook/bcaf3d34-b8cc-4376-95d1-b426fb49aea6';

            Http::withoutVerifying()->post($n8nWebhookUrl, [
                'sales_mstr_nbr' => $order->sales_mstr_nbr,
                'sales_mstr_bill' => $order->sales_mstr_bill,
                'sales_mstr_date' => $order->sales_mstr_date,
                'sales_mstr_total' => number_format($order->sales_mstr_total, 0, ',', '.'),
            ]);

            // hit calculateAndNotify Mrp mrpMstrController
            $mrpMstrController = new MrpMstrController();
            $mrpMstrController->calculateAndNotify();
            // end hit calculateAndNotify Mrp mrpMstrController

            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($salesDetUuid)
    {
        //
        $salesDet = SalesDet::where('sales_det_uuid', $salesDetUuid)->with('salesMstr')->firstOrFail();

        // dd($salesDet);

        if ($salesDet->delete()) {

            // $this->rowInserted($salesDet->sales_det_mstr, $salesDet->sales_det_id);
            // delete odm_mstr
            $sql = "DELETE FROM odm_mstr WHERE odm_mstr_nbr = ? AND odm_mstr_sodid = ?";
            DB::delete($sql, [$salesDet->salesMstr->sales_mstr_nbr, $salesDet->sales_det_id]);
            RunMrpJob::dispatch();

            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }

    public function rowInsertedV1($idSo, $idSod)
    {
        $sql = "SELECT sales_mstr_nbr as nbr FROM sales_mstr WHERE sales_mstr_id = ?";
        $row = DB::selectOne($sql, [$idSo]);

        $createBy = Auth::user()->id;

        if (!$row) {
            return false;
        }

        $nbr = $row->nbr;

        $sql2 = "SELECT SUM(sales_det_total) as ttlSales FROM sales_det WHERE sales_det_mstr = ?";
        $row2 = DB::selectOne($sql2, [$idSo]);

        if (!$row2) {
            return false;
        }

        $ttlSales = $row2->ttlSales ?? 0;

        $updated = DB::update("UPDATE sales_mstr SET sales_mstr_total = ? WHERE sales_mstr_id = ?", [$ttlSales, $idSo]);

        // data detail
        $sod = SalesDet::findOrFail($idSod);
        $idSod = $sod->sales_det_id;
        $fgId = $sod->sales_det_item;
        $parent = $sod->sales_det_item;
        $qtyReq = $sod->sales_det_qty;

        $nbr = $nbr;

        // cek if item still on item mstr
        $data = ItemMstr::findOrFail($parent);
        if (!empty($data)) {
            $rowdata = $data;
            $fg_um = $data->item_uom;
        }

        // dump($rowdata);

        // cek if existing on odm then delete

        $cek = DB::select("SELECT * FROM odm_mstr WHERE odm_mstr_nbr = ? AND odm_mstr_sodid = ?", [$nbr, $idSod]);
        if ($cek) {
            $delOdm = DB::delete("DELETE FROM odm_mstr WHERE odm_mstr_nbr = ? AND odm_mstr_sodid = ?", [$nbr, $idSod]);
        }

        $data1 = DB::select("SELECT bom_mstr.* , 
                                item_mstr.item_name as name, 
                                item_mstr.item_desc as desc1,
                                item_mstr.item_rjrate as yield,
                                item_mstr.item_uom as uom 
                                FROM bom_mstr left JOIN item_mstr 
                                ON bom_mstr.bom_mstr_child = item_mstr.item_id 
                                WHERE bom_mstr.bom_mstr_parent = ? 
                                AND item_status = 'true'", [$parent]);


        // dd($data1);
        if (!empty($data1)) {

            // looping bom dan insert berdasarkan level

            for ($i = 0; $i < count($data1); $i++) {

                $parent = $data1[$i]->bom_mstr_parent;
                $child = $data1[$i]->bom_mstr_child;
                $yield = $data1[$i]->yield;
                $uom = $data1[$i]->uom;
                $qty = $qtyReq * $data1[$i]->bom_mstr_qtyper;
                $lvl = "LVL1";

                $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);

                // level2
                $data2 = DB::select("SELECT bom_mstr.* , 
                                        item_mstr.item_name as name, 
                                        item_mstr.item_desc as desc1,
                                        item_mstr.item_rjrate as yield,
                                        item_mstr.item_uom as uom 
                                        FROM bom_mstr left JOIN item_mstr 
                                        ON bom_mstr.bom_mstr_child = item_mstr.item_id 
                                        WHERE bom_mstr.bom_mstr_parent = ? 
                                        AND item_status = 'true'", [$child]);

                if (!empty($data2)) {
                    for ($j = 0; $j < count($data2); $j++) {
                        $parent = $data2[$j]->bom_mstr_parent;
                        $child = $data2[$j]->bom_mstr_child;
                        $yield = $data2[$j]->yield;
                        $uom = $data2[$j]->uom;
                        $qty = $qtyReq * $data1[$i]->bom_mstr_qtyper * $data2[$j]->bom_mstr_qtyper;
                        $lvl = "LVL2";

                        $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);

                        // level3
                        $data3 = DB::select("SELECT bom_mstr.* , 
                                                item_mstr.item_name as name, 
                                                item_mstr.item_desc as desc1,
                                                item_mstr.item_rjrate as yield,
                                                item_mstr.item_uom as uom 
                                                FROM bom_mstr left JOIN item_mstr 
                                                ON bom_mstr.bom_mstr_child = item_mstr.item_id 
                                                WHERE bom_mstr.bom_mstr_parent = ? 
                                                AND item_status = 'true'", [$child]);

                        if (!empty($data3)) {
                            for ($k = 0; $k < count($data3); $k++) {
                                $parent = $data3[$k]->bom_mstr_parent;
                                $child = $data3[$k]->bom_mstr_child;
                                $yield = $data3[$k]->yield;
                                $uom = $data3[$k]->uom;
                                $qty = $qtyReq * $data1[$i]->bom_mstr_qtyper * $data2[$j]->bom_mstr_qtyper * $data3[$k]->bom_mstr_qtyper;
                                $lvl = "LVL3";

                                $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);

                                // level4
                                $data4 = DB::select("SELECT bom_mstr.* , 
                                                        item_mstr.item_name as name, 
                                                        item_mstr.item_desc as desc1,
                                                        item_mstr.item_rjrate as yield,
                                                        item_mstr.item_uom as uom 
                                                        FROM bom_mstr left JOIN item_mstr 
                                                        ON bom_mstr.bom_mstr_child = item_mstr.item_id 
                                                        WHERE bom_mstr.bom_mstr_parent = ? 
                                                        AND item_status = 'true'", [$child]);

                                if (!empty($data4)) {
                                    for ($l = 0; $l < count($data4); $l++) {
                                        $parent = $data4[$l]->bom_mstr_parent;
                                        $child = $data4[$l]->bom_mstr_child;
                                        $yield = $data4[$l]->yield;
                                        $uom = $data4[$l]->uom;
                                        $qty = $qtyReq * $data1[$i]->bom_mstr_qtyper * $data2[$j]->bom_mstr_qtyper * $data3[$k]->bom_mstr_qtyper * $data4[$l]->bom_mstr_qtyper;
                                        $lvl = "LVL4";

                                        $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);

                                        // level5
                                        $data5 = DB::select("SELECT bom_mstr.* , 
                                                                item_mstr.item_name as name, 
                                                                item_mstr.item_desc as desc1,
                                                                item_mstr.item_rjrate as yield,
                                                                item_mstr.item_uom as uom 
                                                                FROM bom_mstr left JOIN item_mstr 
                                                                ON bom_mstr.bom_mstr_child = item_mstr.item_id 
                                                                WHERE bom_mstr.bom_mstr_parent = ? 
                                                                AND item_status = 'true'", [$child]);

                                        if (!empty($data5)) {
                                            for ($m = 0; $m < count($data5); $m++) {
                                                $parent = $data5[$m]->bom_mstr_parent;
                                                $child = $data5[$m]->bom_mstr_child;
                                                $yield = $data5[$m]->yield;
                                                $uom = $data5[$m]->uom;
                                                $qty = $qtyReq * $data1[$i]->bom_mstr_qtyper * $data2[$j]->bom_mstr_qtyper * $data3[$k]->bom_mstr_qtyper * $data4[$l]->bom_mstr_qtyper * $data5[$m]->bom_mstr_qtyper;
                                                $lvl = "LVL5";

                                                $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                                                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {

            $parent = $fgId;
            $child = $fgId;
            $yield = 0;
            $uom = $fg_um;
            $qty = $qtyReq;
            $lvl = "LVL1";

            $insOdm = DB::insert("INSERT INTO odm_mstr (odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level, odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb, created_at, updated_at) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [$nbr, $idSod, $parent, $child, $yield, $uom, $qty, $lvl, $fgId, $fg_um, $qtyReq, $createBy]);
        }

        return $updated > 0;
    }

    public function rowInserted($idSo, $idSod)
    {
        $sql = "SELECT sales_mstr_nbr as nbr FROM sales_mstr WHERE sales_mstr_id = ?";
        $row = DB::selectOne($sql, [$idSo]);

        $createBy = Auth::user()->id;

        if (!$row) {
            return false;
        }

        $nbr = $row->nbr;

        $sql2 = "SELECT SUM(sales_det_total) as ttlsales FROM sales_det WHERE sales_det_mstr = ?";
        $row2 = DB::selectOne($sql2, [$idSo]);

        if (!$row2) {
            return false;
        }

        $ttlSales = $row2->ttlsales ?? 0;
        $updated = DB::update("UPDATE sales_mstr SET sales_mstr_total = ? WHERE sales_mstr_id = ?", [$ttlSales, $idSo]);

        $sod = SalesDet::findOrFail($idSod);
        $idSod = $sod->sales_det_id;
        $fgId = $sod->sales_det_item;
        $parent = $sod->sales_det_item;
        $qtyReq = $sod->sales_det_qty;

        $data = ItemMstr::findOrFail($parent);
        if (!empty($data)) {
            $fg_um = $data->item_uom;
        }

        $cek = DB::select("SELECT * FROM odm_mstr WHERE odm_mstr_nbr = ? AND odm_mstr_sodid = ?", [$nbr, $idSod]);
        if ($cek) {
            $delOdm = DB::delete("DELETE FROM odm_mstr WHERE odm_mstr_nbr = ? AND odm_mstr_sodid = ?", [$nbr, $idSod]);
        }

        $bomData = DB::select("SELECT bom_mstr.*,
                          item_mstr.item_name as name,
                          item_mstr.item_desc as desc1,
                          item_mstr.item_rjrate as yield,
                          item_mstr.item_uom as uom
                          FROM bom_mstr 
                          LEFT JOIN item_mstr ON bom_mstr.bom_mstr_child = item_mstr.item_id
                          WHERE bom_mstr.bom_mstr_parent = ?
                          AND item_status = 'true'", [$parent]);

        if (!empty($bomData)) {
            $currentLevel = 1;
            $currentParents = [$parent];
            $currentQtyFactors = [1];

            while ($currentLevel <= 18 && !empty($currentParents)) {
                $nextParents = [];
                $nextQtyFactors = [];

                foreach ($currentParents as $index => $currentParent) {
                    $levelData = DB::select("SELECT bom_mstr.*,
                                      item_mstr.item_rjrate as yield,
                                      item_mstr.item_uom as uom
                                      FROM bom_mstr
                                      LEFT JOIN item_mstr ON bom_mstr.bom_mstr_child = item_mstr.item_id
                                      WHERE bom_mstr.bom_mstr_parent = ?
                                      AND item_status = 'true'", [$currentParent]);

                    foreach ($levelData as $item) {
                        $qty = $qtyReq * $currentQtyFactors[$index] * $item->bom_mstr_qtyper;
                        $lvl = "LVL" . $currentLevel;

                        DB::insert("INSERT INTO odm_mstr (
                        odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child, 
                        odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level,
                        odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb,
                        created_at, updated_at
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [
                            $nbr,
                            $idSod,
                            $currentParent,
                            $item->bom_mstr_child,
                            $item->yield,
                            $item->uom,
                            $qty,
                            $lvl,
                            $fgId,
                            $fg_um,
                            $qtyReq,
                            $createBy
                        ]);
                        $nextParents[] = $item->bom_mstr_child;
                        $nextQtyFactors[] = $currentQtyFactors[$index] * $item->bom_mstr_qtyper;
                    }
                }
                $currentParents = $nextParents;
                $currentQtyFactors = $nextQtyFactors;
                $currentLevel++;
            }
        } else {
            DB::insert("INSERT INTO odm_mstr (
            odm_mstr_nbr, odm_mstr_sodid, odm_mstr_parent, odm_mstr_child,
            odm_mstr_rjrate, odm_mstr_childuom, odm_mstr_req, odm_mstr_level,
            odm_mstr_fg, odm_mstr_fguom, odm_mstr_qtyorder, odm_mstr_cb,
            created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())", [
                $nbr,
                $idSod,
                $fgId,
                $fgId,
                0,
                $fg_um,
                $qtyReq,
                "LVL1",
                $fgId,
                $fg_um,
                $qtyReq,
                $createBy
            ]);
        }

        return $updated > 0;
    }
}
