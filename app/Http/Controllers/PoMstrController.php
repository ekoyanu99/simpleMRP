<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoMstr;
use App\Http\Requests\StorePoMstrRequest;
use App\Http\Requests\UpdatePoMstrRequest;
use App\Models\ItemMstr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PoMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('po.index');
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = PoMstr::query();

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('action', 'po.datatable')
            ->addColumn('updated_at', function ($po_mstr) {
                return $po_mstr->updated_at->diffForHumans();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('PoMstrs');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePoMstrRequest $request)
    {
        //

        try {

            $id = Auth::user()->id;

            // dd($request->all());

            $poMstr = PoMstr::create([
                'po_mstr_nbr' => $request->po_mstr_nbr,
                'po_mstr_date' => $request->po_mstr_date,
                'po_mstr_vendor' => $request->po_mstr_vendor,
                'po_mstr_delivery_date' => $request->po_mstr_delivery_date,
                'po_mstr_arrival_date' => $request->po_mstr_arrival_date,
                'po_mstr_status' => 1,
                'po_mstr_remarks' => $request->po_mstr_remarks,
                'po_mstr_total' => 0,
                'po_mstr_cb' => $id
            ]);

            return redirect('PoMstrs')->with('status', 'success');
        } catch (\Throwable $th) {

            dd($th);
            return redirect('PoMstrs')->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($poMstrId)
    {
        //
        $poMstr = PoMstr::with('poDet.itemMstr')->findOrFail($poMstrId);
        $items = ItemMstr::where('item_pmcode', 'P')->get();
        return view('po.edit', compact('poMstr', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($poMstrId)
    {
        $poMstr = PoMstr::with('poDet.itemMstr')->findOrFail($poMstrId);
        $items = ItemMstr::where('item_pmcode', 'P')->get();
        return view('po.edit', compact('poMstr', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoMstrRequest $request, $id)
    {
        //
        $poMstr = PoMstr::findOrFail($id);
        $id = Auth::user()->id;

        $data = [
            'po_mstr_nbr' => $request->efid_nbr ?? $poMstr->po_mstr_nbr,
            'po_mstr_date' => $request->efid_date ?? $poMstr->po_mstr_date,
            'po_mstr_vendor' => $request->efid_vendor ?? $poMstr->po_mstr_vendor,
            'po_mstr_delivery_date' => $request->efid_delivery ?? $poMstr->po_mstr_delivery_date,
            'po_mstr_arrival_date' => $request->efid_arrival ?? $poMstr->po_mstr_arrival_date,
            'po_mstr_remarks' => $request->efid_remarks ?? $poMstr->po_mstr_remarks,
            'po_mstr_cb' => $id
        ];

        $poMstr->update($data);

        return redirect()->back()->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($poMstrId)
    {
        //
        $poMstr = PoMstr::findOrFail($poMstrId);
        if ($poMstr->delete()) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }
}
