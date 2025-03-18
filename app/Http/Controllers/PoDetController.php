<?php

namespace App\Http\Controllers;

use App\Models\PoDet;
use App\Http\Requests\StorePoDetRequest;
use App\Http\Requests\UpdatePoDetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoDetController extends Controller
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
    public function store(StorePoDetRequest $request)
    {

        //
        try {
            $id = Auth::user()->id;

            $total = $request->pod_det_qty * $request->pod_det_price;
            $uom = DB::table('item_mstr')->where('item_mstr_id', $request->pod_det_item)->value('item_uom');

            $poDet = PoDet::create([
                'pod_det_mstr' => $request->pod_det_mstr,
                'pod_det_item' => $request->pod_det_item,
                'pod_det_desc' => $request->pod_det_desc,
                'pod_det_qty' => $request->pod_det_qty,
                'pod_det_uom' => $request->pod_det_uom ?? $uom,
                'pod_det_price' => $request->pod_det_price,
                'pod_det_subtotal' => $total ?? 0,
                'pod_det_status' => $request->pod_det_status ?? 0,
                'pod_det_remarks' => $request->pod_det_remarks,
                'pod_det_cb' => $id
            ]);

            if ($poDet) {
                return redirect()->back()->with('status', 'success');
            } else {
                return redirect()->back()->with('status', 'error');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PoDet $poDet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoDet $poDet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoDetRequest $request, $id)
    {
        //
        $poDet = PoDet::findOrFail($id);
        try {
            $id = Auth::user()->id;

            $total = $request->pod_det_qty * $request->pod_det_price;

            $data = [
                'pod_det_mstr' => $request->pod_det_mstr ?? $poDet->pod_det_mstr,
                'pod_det_item' => $request->pod_det_item ?? $poDet->pod_det_item,
                'pod_det_desc' => $request->pod_det_desc ?? $poDet->pod_det_desc,
                'pod_det_qty' => $request->pod_det_qty ?? $poDet->pod_det_qty,
                'pod_det_uom' => $request->pod_det_uom ?? $poDet->pod_det_uom,
                'pod_det_price' => $request->pod_det_price ?? $poDet->pod_det_price,
                'pod_det_subtotal' => $total,
                'pod_det_status' => $request->pod_det_status ?? $poDet->pod_det_status,
                'pod_det_remarks' => $request->pod_det_remarks ?? $poDet->pod_det_remarks,
                'pod_det_cb' => $id
            ];

            $poDet->update($data);

            return redirect()->back()->with('status', 'success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($poDetId)
    {
        //
        $poDet = PoDet::findOrFail($poDetId);
        try {
            $poDet->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'error');
        }
    }
}
