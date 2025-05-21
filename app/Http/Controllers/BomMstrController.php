<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BomMstr;
use App\Http\Requests\StoreBomMstrRequest;
use App\Http\Requests\UpdateBomMstrRequest;
use App\Models\ItemMstr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BomMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemmstrs = ItemMstr::all();
        return view('bommstr.index', compact('itemmstrs'));
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = DB::table(DB::raw('item_mstr, bom_mstr AS ps'))
            ->selectRaw('
                item_mstr.*,
                pt1.item_name AS item_name_par,
                pt1.item_desc AS item_parent_desc,
                pt2.item_name AS item_name_comp,
                pt2.item_desc AS item_comp_desc,
                pt2.item_uom AS item_comp_um,
                ps.*')
            ->leftJoin(DB::raw('item_mstr AS pt1'), 'ps.bom_mstr_parent', '=', 'pt1.item_id')
            ->leftJoin(DB::raw('item_mstr AS pt2'), 'ps.bom_mstr_child', '=', 'pt2.item_id')
            ->whereRaw('item_mstr.item_id = ps.bom_mstr_parent');

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
            ->addColumn('action', 'bommstr.datatable')
            ->addColumn('updated_at', function ($item) {
                return $item->updated_at ? formatWaktuHuman($item->updated_at) : '';
            })
            ->editColumn('bom_mstr_qtyper', function ($item) {
                return $item->bom_mstr_qtyper ? formatNumberV2($item->bom_mstr_qtyper) : 0;
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
    public function store(StoreBomMstrRequest $request)
    {
        //
        $id = Auth::user()->id;

        // validation

        BomMstr::create([
            'bom_mstr_parent' => $request->bom_mstr_parent,
            'bom_mstr_child' => $request->bom_mstr_child,
            'bom_mstr_qtyper' => $request->bom_mstr_qtyper,
            'bom_mstr_start' => $request->bom_mstr_start,
            'bom_mstr_expire' => $request->bom_mstr_expire,
            'bom_mstr_status' => 1,
            'bom_mstr_remark' => $request->bom_mstr_remark ?? '',
            'bom_mstr_cb' => $id
        ]);

        return redirect('BomMstrs')->with('success', 'Bom created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BomMstr $bomMstr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BomMstr $bomMstr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBomMstrRequest $request, BomMstr $bomMstr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bomMstrId)
    {
        //
        $bomMstr = BomMstr::findOrFail($bomMstrId);
        $bomMstr->delete();

        return redirect('BomMstrs')->with('success', 'Bom deleted successfully');
    }
}
