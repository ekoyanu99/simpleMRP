<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InDet;
use App\Http\Requests\StoreInDetRequest;
use App\Http\Requests\UpdateInDetRequest;
use App\Models\ItemMstr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InDetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ItemMstr::all();
        return view('indet.index', compact(['items']));
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = InDet::query()->with('itemMstr');

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('in_det_item', function ($in_det) {
                return $in_det->itemMstr->item_name;
            })
            ->addColumn('in_det_itemdesc', function ($in_det) {
                return $in_det->itemMstr->item_desc;
            })
            ->editColumn('in_det_qty', function ($in_det) {
                return formatNumberV2($in_det->in_det_qty);
            })
            ->addColumn('in_det_uom', function ($in_det) {
                return $in_det->itemMstr->item_uom;
            })
            ->addColumn('action', function ($in_det) {
                $itemMstr = $in_det->itemMstr;
                return view('inDet.datatable', compact('in_det', 'itemMstr'))->render();
            })
            ->addColumn('updated_at', function ($in_det) {
                return formatWaktuHuman($in_det->updated_at);
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
    public function store(StoreInDetRequest $request)
    {
        try {
            $id = Auth::user()->id;

            // dd($request->all());

            $inDet = InDet::create([
                'in_det_mstr' => '1',
                'in_det_loc' => 'WH-001',
                'in_det_item' => $request->in_det_item,
                'in_det_qty' => $request->in_det_qty,
                'in_det_cb' => $id
            ]);

            dd($inDet);

            return redirect()->back()->with('status', 'success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InDet $inDet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InDet $inDet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInDetRequest $request, $id)
    {
        //
        $inDet = InDet::findOrFail($id);

        $data = [
            'in_det_qty' => $request->efid_Qty,
            'in_det_cb' => Auth::user()->id
        ];

        if ($inDet->update($data)) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InDet $inDet)
    {
        //
    }
}
