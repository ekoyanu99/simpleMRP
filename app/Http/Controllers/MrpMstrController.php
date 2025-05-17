<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MrpMstr;
use App\Http\Requests\StoreMrpMstrRequest;
use App\Http\Requests\UpdateMrpMstrRequest;
use App\Models\MrpDet;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class MrpMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mrp.index');
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = MrpMstr::with('itemMstr');

        $mrp_mstr = $q->get();

        return DataTables::of($mrp_mstr)
            ->editColumn('mrp_mstr_item', function ($mrp_mstr) {
                return $mrp_mstr->itemMstr->item_name;
            })
            ->addColumn('mrp_mstr_itemdesc', function ($mrp_mstr) {
                return $mrp_mstr->itemMstr->item_desc;
            })
            ->editColumn('mrp_mstr_saldo', function ($mrp_mstr) {
                return $mrp_mstr->mrp_mstr_saldo ? formatNumberV2($mrp_mstr->mrp_mstr_saldo) : 0;
            })
            ->editColumn('mrp_mstr_outstanding', function ($mrp_mstr) {
                return $mrp_mstr->mrp_mstr_outstanding ? formatNumberV2($mrp_mstr->mrp_mstr_outstanding) : 0;
            })
            ->editColumn('mrp_mstr_summary', function ($mrp_mstr) {
                return $mrp_mstr->mrp_mstr_summary ? formatNumberV2($mrp_mstr->mrp_mstr_summary) : 0;
            })
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '<button class="btn btn-sm btn-primary">Aksi</button>')
            ->make(true);
    }

    public function detailData($id)
    {
        $details = MrpDet::where('mrp_det_mstr', $id)->get();
        return view('mrp._mrpdet_table', compact('details'));
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
    public function store(StoreMrpMstrRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MrpMstr $mrpMstr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MrpMstr $mrpMstr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMrpMstrRequest $request, MrpMstr $mrpMstr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MrpMstr $mrpMstr)
    {
        //
    }

    public function generateMrp()
    {

        // Truncate the table mrp_mstr and mrp_det
        MrpMstr::truncate();
        MrpDet::truncate();

        // SELECT item_mstr_id FROM odm_mstr, item_mstr WHERE item_mstr_id = odm_mstr_child AND item_pmcode = 'P' GROUP BY item_mstr_id

        $odm_mstr = DB::table('odm_mstr')
            ->join('item_mstr', 'item_mstr.item_mstr_id', '=', 'odm_mstr.odm_mstr_child')
            ->where('item_pmcode', 'P')
            ->groupBy('item_mstr.item_mstr_id')
            ->select('item_mstr.item_mstr_id')
            ->get();

        // loop to get 
        /*
        a. stock item
        b. outstanding 
        */

        foreach ($odm_mstr as $item) {
            // outstanding : get qty from po_det item tsb
            $outstanding = DB::table('po_det')
                ->where('pod_det_item', $item->item_mstr_id)
                ->sum('pod_det_qty');

            $mrp_mstr = new MrpMstr();
            $mrp_mstr->mrp_mstr_item = $item->item_mstr_id;
            $mrp_mstr->mrp_mstr_outstanding = $outstanding;
            $mrp_mstr->mrp_mstr_cb = Auth::user()->id;
            $mrp_mstr->save();

            // $table->unsignedBigInteger('mrp_det_mstr')->nullable(false);
            // $table->bigInteger('mrp_det_item');
            // $table->string('mrp_det_sales', 100)->nullable();
            // $table->date('mrp_det_date')->nullable();
            // $table->decimal('mrp_det_qtyreq', 10, 2)->nullable();

            // insert to mrp det

            $data = DB::table('odm_mstr')
                ->join('item_mstr', 'item_mstr.item_mstr_id', '=', 'odm_mstr.odm_mstr_child')
                ->where('item_pmcode', 'P')
                ->where('odm_mstr.odm_mstr_child', $item->item_mstr_id)
                ->get();


            $mrp_det = new MrpDet();
            $mrp_det->mrp_det_mstr = $mrp_mstr->mrp_mstr_id;
            $mrp_det->mrp_det_item = $item->item_mstr_id;
            $mrp_det->mrp_det_sales = $data[0]->odm_mstr_nbr;
            // $mrp_det->mrp_det_date = $data[0]->odm_mstr_date;
            $mrp_det->mrp_det_qtyreq = $data[0]->odm_mstr_req;
            $mrp_det->mrp_det_cb = Auth::user()->id;
            $mrp_det->save();
        }

        return redirect()->route('MrpMstrs.index')->with('success', 'MRP has been generated');
    }
}
