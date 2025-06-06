<?php

namespace App\Http\Controllers;

use App\Models\InDet;
use App\Models\MrpMstr;
use App\Models\PoMstr;
use App\Models\SalesMstr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // jika user login
        if (auth()->check()) {
            $newSOCount = SalesMstr::whereDate('created_at', today())->count();
            $newMRCount = MrpMstr::where('mrp_mstr_summary', '>', 0)->count();
            $lowStockCount = InDet::where('in_det_qty', '<=', 10)->count();
            $outstandingPOCount = PoMstr::where('po_mstr_status', '=', '1')->count() ?? 0;

            $unprocessedSOCount = SalesMstr::where('sales_mstr_status', '=', '1')->count();

            $sqlQuery = "
            SELECT
                TO_CHAR(ds.day, 'Dy') AS label,
                COUNT(sm.sales_mstr_id) AS total
            FROM
                (
                    SELECT generate_series(
                        current_date - interval '6 days',
                        current_date,
                        '1 day'
                    )::date AS day
                ) AS ds
            LEFT JOIN
                sales_mstr sm ON ds.day = sm.sales_mstr_date::date
            GROUP BY
                ds.day
            ORDER BY
                ds.day ASC
        ";

            $salesResults = DB::select($sqlQuery);

            $dayMap = [
                'Mon' => 'Sen',
                'Tue' => 'Sel',
                'Wed' => 'Rab',
                'Thu' => 'Kam',
                'Fri' => 'Jum',
                'Sat' => 'Sab',
                'Sun' => 'Min'
            ];

            $labels = [];
            $data = [];
            foreach ($salesResults as $row) {
                $englishLabel = trim($row->label);
                $labels[] = $dayMap[$englishLabel] ?? $englishLabel;
                $data[] = $row->total;
            }

            $salesChartData = [
                'labels' => $labels,
                'data'   => $data,
            ];

            // SELECT i.item_prod_line as labels, count(*) as datas FROM in_det as l JOIN item_mstr as i ON l.in_det_item = i.item_id GROUP BY i.item_prod_line
            $sqlQuery = "SELECT i.item_prod_line as label, count(*) as total FROM in_det as l JOIN item_mstr as i ON l.in_det_item = i.item_id GROUP BY i.item_prod_line";
            $inventoryComposition = DB::select($sqlQuery);
            $labels = [];
            $data = [];
            foreach ($inventoryComposition as $row) {
                $labels[] = $row->label;
                $data[] = $row->total;
            }

            $inventoryChartData = [
                'labels' => $labels,
                'data'   => $data,
            ];

            return view('home', compact(
                'newSOCount',
                'newMRCount',
                'lowStockCount',
                'outstandingPOCount',
                'unprocessedSOCount',
                'salesChartData',
                'inventoryChartData'
            ));
            return view('home');
        } else {
            return view('welcome');
        }
    }
}
