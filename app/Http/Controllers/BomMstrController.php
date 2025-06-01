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

    public function calculateBom(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:item_mstr,item_id',
            'quantity' => 'required|numeric|min:0.01'
        ]);

        $fgId = $request->item_id;
        $qtyReq = $request->quantity;
        $maxLevel = 20;

        // Get FG item data
        $fgItem = ItemMstr::findOrFail($fgId);
        $fg_um = $fgItem->item_uom;

        // Get BOM data
        $bomData = DB::select("SELECT bom_mstr.*,
                      item_mstr.item_name as name,
                      item_mstr.item_desc as desc1,
                      item_mstr.item_rjrate as yield,
                      item_mstr.item_uom as uom
                      FROM bom_mstr 
                      LEFT JOIN item_mstr ON bom_mstr.bom_mstr_child = item_mstr.item_id
                      WHERE bom_mstr.bom_mstr_parent = ?
                      AND item_status = 'true'", [$fgId]);

        $results = [];
        $totalComponents = 0;

        if (!empty($bomData)) {
            $currentLevel = 1;
            $currentParents = [$fgId];
            $currentQtyFactors = [1];

            while ($currentLevel <= $maxLevel && !empty($currentParents)) {
                $nextParents = [];
                $nextQtyFactors = [];

                foreach ($currentParents as $index => $currentParent) {
                    $levelData = DB::select("SELECT bom_mstr.*,
                                  item_mstr.item_name as name,
                                  item_mstr.item_desc as desc1,
                                  item_mstr.item_rjrate as yield,
                                  item_mstr.item_uom as uom
                                  FROM bom_mstr
                                  LEFT JOIN item_mstr ON bom_mstr.bom_mstr_child = item_mstr.item_id
                                  WHERE bom_mstr.bom_mstr_parent = ?
                                  AND item_status = 'true'", [$currentParent]);

                    foreach ($levelData as $item) {
                        $qty = $qtyReq * $currentQtyFactors[$index] * $item->bom_mstr_qtyper;
                        $totalComponents++;

                        $results[] = [
                            'level' => $currentLevel,
                            'parent' => $currentParent,
                            'parent_name' => $this->getItemName($currentParent),
                            'component' => $item->bom_mstr_child,
                            'component_name' => $item->name,
                            'uom' => $item->uom,
                            'required_qty' => round($qty, 4),
                            'yield' => $item->yield,
                            'qty_per' => $item->bom_mstr_qtyper
                        ];

                        $nextParents[] = $item->bom_mstr_child;
                        $nextQtyFactors[] = $currentQtyFactors[$index] * $item->bom_mstr_qtyper;
                    }
                }

                $currentParents = $nextParents;
                $currentQtyFactors = $nextQtyFactors;
                $currentLevel++;
            }
        } else {
            // Single level item
            $results[] = [
                'level' => 1,
                'parent' => $fgId,
                'parent_name' => $fgItem->item_name,
                'component' => $fgId,
                'component_name' => $fgItem->item_name,
                'uom' => $fg_um,
                'required_qty' => round($qtyReq, 4),
                'yield' => $fgItem->item_rjrate ?? 0,
                'qty_per' => 1
            ];
            $totalComponents = 1;
        }

        $bomTreeData = $this->buildBomTree($results, $fgId, $qtyReq);
        $bomTreeJson = json_encode($bomTreeData);

        return view('bomcalc.index', [
            'results' => $results,
            'fgItem' => $fgItem,
            'qtyReq' => $qtyReq,
            'totalComponents' => $totalComponents,
            'bomTreeJson' => $bomTreeJson,
        ]);
    }

    private function getItemName($itemId)
    {
        return ItemMstr::find($itemId)->item_name ?? 'N/A';
    }

    public function showCalculatorForm()
    {
        $items = ItemMstr::where('item_status', 'true')->get();
        return view('bomcalc.form', compact('items'));
    }

    /**
     * Mengubah data BOM yang linear menjadi struktur pohon (hirarkis).
     *
     * @param array $linearBomData Data BOM hasil dari calculateBom (array 'bom_components')
     * @param int $fgItemId ID Item Finished Good
     * @param float $qtyReq Kuantitas FG awal yang diminta
     * @return array Struktur data BOM dalam format pohon
     */

    protected function buildBomTree(array $linearBomData, int $fgItemId, float $qtyReq): array
    {
        $nodes = [];
        $childrenMap = [];

        $allItemIds = [];
        foreach ($linearBomData as $item) {
            $allItemIds[$item['parent']] = true;
            $allItemIds[$item['component']] = true;
        }
        $allItemIds[$fgItemId] = true;

        $itemMstrData = ItemMstr::whereIn('item_id', array_keys($allItemIds))
            ->get()
            ->keyBy('item_id');

        foreach ($allItemIds as $itemId => $dummy) {
            $itemData = $itemMstrData->get($itemId);
            if ($itemData) {
                $nodes[$itemId] = [
                    'id' => $itemId,
                    'name' => $itemData->item_name,
                    'description' => $itemData->item_desc ?? null,
                    'uom' => $itemData->item_uom,
                    'qty_needed' => 0,
                    'children' => []
                ];
            }
        }

        foreach ($linearBomData as $item) {
            $parentId = $item['parent'];
            $childId = $item['component'];

            if (isset($nodes[$childId])) {
                $nodes[$childId]['qty_needed'] = $item['required_qty'];

                if (!isset($childrenMap[$parentId])) {
                    $childrenMap[$parentId] = [];
                }
                $childrenMap[$parentId][] = $childId;
            }
        }

        if (isset($nodes[$fgItemId])) {
            $nodes[$fgItemId]['qty_needed'] = $qtyReq;
        } else {
            return [];
        }

        $root = &$nodes[$fgItemId];

        foreach ($nodes as $id => &$node) {
            if (isset($childrenMap[$id])) {
                foreach ($childrenMap[$id] as $childId) {
                    if (isset($nodes[$childId])) {
                        // Tambahkan child ke array children dari parent menggunakan REFERENSI node
                        $node['children'][] = &$nodes[$childId];
                    }
                }
            }
        }
        unset($node);

        return [$root];
    }
}
