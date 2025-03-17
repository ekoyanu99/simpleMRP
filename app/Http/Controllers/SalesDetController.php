<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesDet;
use App\Http\Requests\StoreSalesDetRequest;
use App\Http\Requests\UpdateSalesDetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function update(UpdateSalesDetRequest $request, $id)
    {
        //
        $salesDet = SalesDet::findOrFail($id);
        $id = Auth::user()->id;

        $total = $request->efid_Price * $request->sales_det_price;

        $data = [
            'sales_det_date' => $request->efid_Date ?? $salesDet->sales_det_date,
            'sales_det_duedate' => $request->efid_Due ?? $salesDet->sales_det_duedate,
            'sales_det_qty' => $request->efid_Qty ?? $salesDet->sales_det_qty,
            'sales_det_price' => $request->efid_Price ?? $salesDet->sales_det_price,
            'sales_det_total' => $total,
        ];

        if ($salesDet->update($data)) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($salesDetId)
    {
        //
        $salesDet = SalesDet::findOrFail($salesDetId);

        if ($salesDet->delete()) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }

    public function rowInserted($idSo, $idSod)
    {
        $sql = "SELECT sales_mstr_nbr as nbr FROM sales_mstr WHERE sales_mstr_id = ?";
        $row = DB::selectOne($sql, [$idSo]);

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

        return $updated > 0;
    }
}
