<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesMstr;
use App\Http\Requests\StoreSalesMstrRequest;
use App\Http\Requests\UpdateSalesMstrRequest;
use App\Models\ItemMstr;
use App\Models\OdmMstr;
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

        $q = SalesMstr::with('user')->filter($request);

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('action', 'sales.datatable')
            ->addColumn('updated_at', function ($sales) {
                return $sales->updated_at->diffForHumans();
            })
            ->addColumn('sales_mstr_total', function ($sales) {
                return formatCurrency($sales->sales_mstr_total);
            })
            ->editColumn('sales_mstr_due_date', function ($sales) {
                return $sales->sales_mstr_due_date ? formatWaktuHuman($sales->sales_mstr_due_date) : '';
            })
            ->editColumn('sales_mstr_date', function ($sales) {
                return $sales->sales_mstr_date ? formatDateIndo($sales->sales_mstr_date) : '';
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

            return redirect()->route('SalesMstrs.show', $salesMstr->sales_mstr_uuid)->with('status', 'success');
        } catch (\Throwable $th) {
            return redirect('SalesMstrs')->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($salesMstrUuid)
    {
        //
        $salesMstr = SalesMstr::where('sales_mstr_uuid', $salesMstrUuid)->with(['salesDet', 'salesDet.itemMstr'])->firstOrFail();
        $items = ItemMstr::where('item_prod_line', '=', 'FG')->get();
        return view('sales.edit', compact(['salesMstr', 'items']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($salesMstrUuid)
    {
        //
        $salesMstr = SalesMstr::where('sales_mstr_uuid', $salesMstrUuid)->with(['salesDet', 'salesDet.itemMstr'])->firstOrFail();
        $items = ItemMstr::where('item_prod_line', '=', 'FG')->get();
        return view('sales.edit', compact(['salesMstr', 'items']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesMstrRequest $request, $salesMstrUuid)
    {
        //
        $salesMstr = SalesMstr::where('sales_mstr_uuid', $salesMstrUuid)->firstOrFail();
        $id = Auth::user()->id;

        // dd($salesMstr);

        $data = [
            'sales_mstr_due_date' => $request->sales_mstr_due_date,
            'sales_mstr_bill' => $request->sales_mstr_bill ?? $salesMstr->sales_mstr_bill,
            'sales_mstr_ship' => $request->sales_mstr_ship ?? $salesMstr->sales_mstr_ship,
            'sales_mstr_cb' => $id
        ];

        $salesMstr->update($data);

        return redirect()->back()->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($salesMstrUuid)
    {
        //
        $salesMstr = SalesMstr::where('sales_mstr_uuid', $salesMstrUuid)->firstOrFail();
        // Check if there are any sales details associated with this sales master
        if ($salesMstr->salesDet()->count() > 0) {

            // delete the odm_mstr
            $odmMstr = OdmMstr::where('odm_mstr_nbr', $salesMstr->sales_mstr_nbr)->delete();

            // delete the details first
            $salesMstr->salesDet()->delete();
        }
        if ($salesMstr->delete()) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }
}
