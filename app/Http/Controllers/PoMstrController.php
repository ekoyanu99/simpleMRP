<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoMstr;
use App\Http\Requests\StorePoMstrRequest;
use App\Http\Requests\UpdatePoMstrRequest;
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

        $po_mstr = $q->get();

        // add column time to diffForHumans
        return DataTables::of($po_mstr)
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePoMstrRequest $request)
    {
        //

        try {

            $id = Auth::user()->id;

            $poMstr = PoMstr::create([
                'po_mstr_nbr' => $request->po_mstr_nbr,
                'po_mstr_date' => $request->po_mstr_date,
                'po_mstr_vendor' => $request->po_mstr_vendor,
                'po_mstr_delivery_date' => $request->po_mstr_delivery_date,
                'po_mstr_arrival_date' => $request->po_mstr_arrival_date,
                'po_mstr_status' => 1,
                'po_mstr_remarks' => $request->po_mstr_remarks,
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
    public function show(PoMstr $poMstr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoMstr $poMstr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoMstrRequest $request, PoMstr $poMstr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoMstr $poMstr)
    {
        //
    }
}
