<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesMstr;
use App\Http\Requests\StoreSalesMstrRequest;
use App\Http\Requests\UpdateSalesMstrRequest;
use App\Models\ItemMstr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SalesMstrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('sales.index');
    }

    public function data(Request $request)
    {

        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = SalesMstr::query()->with('user');

        $sales = $q->get();

        // add column time to diffForHumans
        return DataTables::of($sales)
            ->addIndexColumn()
            ->addColumn('action', 'sales.datatable')
            ->addColumn('updated_at', function ($sales) {
                return $sales->updated_at->diffForHumans();
            })
            ->addColumn('sales_mstr_total', function ($sales) {
                return number_format($sales->sales_mstr_total, 2);
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
    public function store(StoreSalesMstrRequest $request)
    {
        //
        try {
            $id = Auth::user()->id;

            $salesMstr = SalesMstr::create([
                'sales_mstr_nbr' => $request->sales_mstr_nbr,
                'sales_mstr_bill' => $request->sales_mstr_bill,
                'sales_mstr_ship' => $request->sales_mstr_ship,
                'sales_mstr_date' => $request->sales_mstr_date,
                'sales_mstr_due_date' => $request->sales_mstr_due_date,
                'sales_mstr_status' => 1,
                'sales_mstr_total' => 0,
                'sales_mstr_cb' => $id
            ]);

            return redirect('SalesMstrs')->with('status', 'success');
        } catch (\Throwable $th) {
            return redirect('SalesMstrs')->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($salesMstrId)
    {
        //
        $salesMstr = SalesMstr::with(['salesDet', 'salesDet.itemMstr'])->findOrFail($salesMstrId);
        $items = ItemMstr::all();
        return view('sales.edit', compact(['salesMstr', 'items']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($salesMstrId)
    {
        //
        $salesMstr = SalesMstr::with(['salesDet', 'salesDet.itemMstr'])->findOrFail($salesMstrId);
        $items = ItemMstr::all();
        return view('sales.edit', compact(['salesMstr', 'items']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesMstrRequest $request, $id)
    {
        //
        $salesMstr = SalesMstr::findOrFail($id);
        $id = Auth::user()->id;

        $data = [
            'sales_mstr_due_date' => $request->efid_Due,
            'sales_mstr_bill' => $request->efid_bill ?? $salesMstr->sales_mstr_bill,
            'sales_mstr_ship' => $request->efid_ship ?? $salesMstr->sales_mstr_ship,
            'sales_mstr_cb' => $id
        ];

        $salesMstr->update($data);

        return redirect()->back()->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($salesMstrId)
    {
        //
        $salesMstr = SalesMstr::findOrFail($salesMstrId);
        if ($salesMstr->delete()) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }
}
