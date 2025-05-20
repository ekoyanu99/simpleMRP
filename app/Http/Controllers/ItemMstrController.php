<?php

namespace App\Http\Controllers;

use App\Exports\ItemMstrExport;
use Illuminate\Http\Request;
use App\Models\ItemMstr;
use App\Http\Requests\StoreItemMstrRequest;
use App\Http\Requests\UpdateItemMstrRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ItemMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('itemmstr.index');
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = ItemMstr::with('user')->filter($request);

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('action', 'itemmstr.datatable')
            ->addColumn('updated_at', function ($item) {
                return $item->updated_at ? formatWaktuHuman($item->updated_at) : '';
            })
            ->editColumn('item_rjrate', function ($item) {
                return $item->item_rjrate ? formatNumberV2($item->item_rjrate) : 0;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function export()
    {
        return Excel::download(new ItemMstrExport, 'ItemMstr.xlsx');
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
    public function store(StoreItemMstrRequest $request)
    {
        //
        $id = Auth::user()->id;

        // validation
        $request->validate([
            'item_name' => 'required|unique:item_mstr,item_name',
            'item_desc' => 'required',
            'item_pmcode' => 'required',
            'item_prod_line' => 'required',
            'item_rjrate' => 'required',
            'item_uom' => 'required',
        ]);

        ItemMstr::create([
            'item_name' => $request->item_name,
            'item_desc' => $request->item_desc,
            'item_pmcode' => $request->item_pmcode,
            'item_prod_line' => $request->item_prod_line,
            'item_rjrate' => $request->item_rjrate,
            'item_status' => 1,
            'item_uom' => $request->item_uom,
            'item_mstr_cb' => $id,
        ]);

        return redirect('ItemMstrs')->with('status', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemMstr $itemMstr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemMstr $itemMstr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemMstrRequest $request, $id)
    {
        //

        $itemMstr = ItemMstr::findOrFail($id);
        $id = Auth::user()->id;
        // validation
        $request->validate([
            // 'efid_Name' => 'required|unique:item_mstr,item_name,' . $itemMstr->id,
            'efid_Desc' => 'required',
        ]);

        $data = [
            'item_desc' => $request->efid_Desc,
            'item_mstr_cb' => $id,
        ];

        $itemMstr->update($data);

        return redirect('ItemMstrs')->with('status', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemMstrId)
    {
        //
        $itemMstr = ItemMstr::findOrFail($itemMstrId);
        $itemMstr->delete();

        return redirect('ItemMstrs')->with('status', 'Item deleted successfully');
    }

    public function getDesc($itemId)
    {
        $item = ItemMstr::findOrFail($itemId);
        return response()->json($item);
    }
}
