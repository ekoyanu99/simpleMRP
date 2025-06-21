<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OdmMstr;
use App\Http\Requests\StoreOdmMstrRequest;
use App\Http\Requests\UpdateOdmMstrRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OdmMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('odmmstr.index');
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = DB::table(DB::raw('item_mstr, odm_mstr AS odm'))
            ->selectRaw('
                item_mstr.*,
                pt1.item_name AS item_name_par,
                pt1.item_desc AS item_parent_desc,
                pt2.item_name AS item_name_comp,
                pt2.item_desc AS item_comp_desc,
                pt2.item_uom AS item_comp_um,
                odm.*')
            ->leftJoin(DB::raw('item_mstr AS pt1'), 'odm.odm_mstr_parent', '=', 'pt1.item_id')
            ->leftJoin(DB::raw('item_mstr AS pt2'), 'odm.odm_mstr_child', '=', 'pt2.item_id')
            ->whereRaw('item_mstr.item_id = odm.odm_mstr_parent');

        if ($request->filled('f_item_parent_name')) {
            $q->where('item_mstr.item_name', 'like', '%' . $request->input('f_item_parent_name') . '%');
        }

        if ($request->filled('f_item_parent_desc')) {
            $q->where('item_mstr.item_desc', 'like', '%' . $request->input('f_item_parent_desc') . '%');
        }

        if ($request->filled('f_item_child_name')) {
            $q->where('pt2.item_name', 'like', '%' . $request->input('f_item_child_name') . '%');
        }

        if ($request->filled('f_item_child_desc')) {
            $q->where('pt2.item_desc', 'like', '%' . $request->input('f_item_child_desc') . '%');
        }

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('action', 'odmmstr.datatable')
            ->addColumn('updated_at', function ($item) {
                return $item->updated_at ? formatWaktuHuman($item->updated_at) : '';
            })
            ->editColumn('odm_mstr_req', function ($item) {
                return $item->odm_mstr_req ? formatNumberV2($item->odm_mstr_req) : 0;
            })
            ->rawColumns(['action'])
            ->make(true);
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
    public function store(StoreOdmMstrRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OdmMstr $odmMstr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OdmMstr $odmMstr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOdmMstrRequest $request, OdmMstr $odmMstr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OdmMstr $odmMstr)
    {
        //
    }
}
