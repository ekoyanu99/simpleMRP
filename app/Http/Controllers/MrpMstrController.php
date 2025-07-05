<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MrpMstr;
use App\Http\Requests\StoreMrpMstrRequest;
use App\Http\Requests\UpdateMrpMstrRequest;
use App\Models\MrpDet;
use App\Models\OdmMstr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        $q = MrpMstr::with('itemMstr')->filter($request);

        return DataTables::of($q)
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
            ->addColumn('mrp_mstr_uom', function ($mrp_mstr) {
                return $mrp_mstr->itemMstr->item_uom;
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
        // Truncate tables
        MrpMstr::truncate();
        MrpDet::truncate();

        // Get all parent items that have child items with PM code 'P'
        $parentItems = DB::table('odm_mstr')
            ->join('item_mstr', 'item_mstr.item_id', '=', 'odm_mstr.odm_mstr_child')
            ->where('item_pmcode', 'P')
            ->groupBy('item_mstr.item_id')
            ->select('item_mstr.item_id')
            ->get();

        foreach ($parentItems as $item) {
            $outstandingPo = DB::table('po_det')
                ->where('pod_det_item', $item->item_id)
                ->sum(DB::raw('pod_det_qty'));

            // Calculate current stock
            $currentStock = DB::table('in_det')
                ->where('in_det_item', $item->item_id)
                ->sum('in_det_qty');

            // Calculate total demand for this item
            $totalDemand = DB::table('odm_mstr')
                ->where('odm_mstr_child', $item->item_id)
                ->sum(DB::raw('CAST(odm_mstr_req AS FLOAT)'));

            // Calculate MR (Material Requirement) - initial calculation
            $materialRequirement = max(0, $totalDemand - $currentStock - $outstandingPo);

            // Create MRP header
            $mrpHeader = MrpMstr::create([
                'mrp_mstr_item' => $item->item_id,
                'mrp_mstr_qtyreq' => $totalDemand,
                'mrp_mstr_outstanding' => $outstandingPo,
                'mrp_mstr_saldo' => $currentStock,
                'mrp_mstr_summary' => $materialRequirement,
                'mrp_mstr_proceded' => false, // Will be updated after detail processing
                'mrp_mstr_cb' => Auth::id() ?? '1'
            ]);

            // Get all demand details for this item
            $demands = DB::table('odm_mstr')
                ->join('sales_det', 'sales_det.sales_det_id', '=', 'odm_mstr.odm_mstr_sodid')
                ->where('odm_mstr_child', $item->item_id)
                ->select(
                    'odm_mstr.odm_mstr_nbr as sales_order',
                    'sales_det.sales_det_duedate as due_date',
                    DB::raw('SUM(odm_mstr.odm_mstr_req) as qty_required')
                )
                ->groupBy('odm_mstr.odm_mstr_nbr', 'sales_det.sales_det_duedate')
                ->orderBy('sales_det.sales_det_duedate')
                ->get();

            // Initialize available resources
            $availableStock = $currentStock;
            $availableOutstanding = $outstandingPo;
            $totalMr = 0;

            foreach ($demands as $demand) {
                $kebutuhan = $demand->qty_required;
                $allocated = 0;
                $issued = 0;
                $mr = 0;

                // Calculate how much we can fulfill from available resources
                $fulfilled = $allocated;
                $remainingNeed = $kebutuhan - $fulfilled;

                // Try to fulfill from available stock
                if ($remainingNeed > 0 && $availableStock > 0) {
                    $takeFromStock = min($remainingNeed, $availableStock);
                    $fulfilled += $takeFromStock;
                    $availableStock -= $takeFromStock;
                    $remainingNeed = $kebutuhan - $fulfilled;
                }

                // Try to fulfill from outstanding PO
                if ($remainingNeed > 0 && $availableOutstanding > 0) {
                    $takeFromOutstanding = min($remainingNeed, $availableOutstanding);
                    $fulfilled += $takeFromOutstanding;
                    $availableOutstanding -= $takeFromOutstanding;
                    $remainingNeed = $kebutuhan - $fulfilled;
                }

                // Remaining need becomes Material Requirement (MR)
                $mr = max(0, $remainingNeed);
                $totalMr += $mr;

                // Determine status
                $status = 'Fulfilled';
                if ($mr > 0) {
                    $status = 'Shortage';
                } elseif ($fulfilled < $kebutuhan) {
                    $status = 'Partial';
                }

                // Create MRP detail
                MrpDet::create([
                    'mrp_det_mstr' => $mrpHeader->mrp_mstr_id,
                    'mrp_det_item' => $item->item_id,
                    'mrp_det_sales' => $demand->sales_order,
                    'mrp_det_date' => $demand->due_date,
                    'mrp_det_qtyreq' => $kebutuhan,
                    'mrp_det_stock' => $allocated, // Using allocated as stock
                    'mrp_det_outstanding' => min($kebutuhan - $allocated, $outstandingPo),
                    'mrp_det_mr' => $mr,
                    'mrp_det_status' => $status,
                    'mrp_det_remarks' => $mr > 0 ? 'Need to purchase' : 'Stock available',
                    'mrp_det_cb' => Auth::id() ?? '1'
                ]);
            }

            // Update header with final MR summary
            $mrpHeader->update([
                'mrp_mstr_summary' => $totalMr,
                'mrp_mstr_proceded' => true
            ]);
        }

        return redirect()->route('MrpMstrs.index')->with('success', 'MRP has been generated successfully');
    }

    public function calculateAndNotify()
    {

        $soNumbers = OdmMstr::whereNull('odm_mstr_status')
            ->pluck('odm_mstr_nbr',)
            ->unique()
            ->toArray();

        // dd($soNumbers);

        $mrpResults = MrpMstr::with('itemMstr')
            ->where('mrp_mstr_proceded', true)
            ->where('mrp_mstr_summary', '>', 0)
            ->get()
            ->map(function ($mrp) {
                return [
                    'item_name' => $mrp->itemMstr->item_name,
                    'item_desc' => $mrp->itemMstr->item_desc,
                    'total_required' => $mrp->mrp_mstr_qtyreq,
                    'stock_on_hand' => $mrp->mrp_mstr_saldo,
                    'outstanding_po' => $mrp->mrp_mstr_outstanding,
                    'suggested_purchase_qty' => max(0, $mrp->mrp_mstr_summary),
                    'uom' => $mrp->itemMstr->item_uom
                ];
            })->toArray();

        if (!empty($mrpResults)) {

            $payload = [
                'mrp_run_id' => 'MRP-' . now()->format('Ymd-His'),
                'triggered_by_so' => array_values($soNumbers),
                'summary' => [
                    'total_items_to_purchase' => count($mrpResults)
                ],
                'items_to_purchase' => $mrpResults
            ];

            // dd($payload);

            try {
                $n8nWebhookUrl = env('N8N1_URL');

                Http::withoutVerifying()->post($n8nWebhookUrl, $payload);
            } catch (\Exception $e) {
                Log::error('Gagal mengirim webhook MRP Summary ke n8n: ' . $e->getMessage());
            }
        }

        // return back()->with('success', 'Proses kalkulasi MRP selesai!');
    }
}
