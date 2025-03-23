<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BomMstr;
use App\Models\ItemMstr;

class BomMstrSeeder extends Seeder
{
    public function run()
    {
        $items = ItemMstr::whereIn('item_name', [
            'SM0001',
            'SM0002',
            'CM0001',
            'CM0002',
            'CP0001',
            'OIL001',
            'OIL002',
            'SK0001',
            'PA0001',
            'PA0002'
        ])->pluck('item_mstr_id', 'item_name');

        $datas = [
            // Level 1 - Sabun Mandi XYZ
            ['bom_mstr_parent' => $items['SM0001'], 'bom_mstr_child' => $items['CM0001'], 'bom_mstr_qtyper' => 5],
            ['bom_mstr_parent' => $items['SM0001'], 'bom_mstr_child' => $items['CP0001'], 'bom_mstr_qtyper' => 500],

            // Level 1 - Sabun Mandi ABC (FG baru)
            ['bom_mstr_parent' => $items['SM0002'], 'bom_mstr_child' => $items['CM0002'], 'bom_mstr_qtyper' => 4],
            ['bom_mstr_parent' => $items['SM0002'], 'bom_mstr_child' => $items['CP0001'], 'bom_mstr_qtyper' => 400],

            // Level 2 - Campuran Minyak Sabun XYZ
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['OIL001'], 'bom_mstr_qtyper' => 1],
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['OIL002'], 'bom_mstr_qtyper' => 0.5],
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['SK0001'], 'bom_mstr_qtyper' => 0.2],

            // Level 2 - Campuran Minyak Sabun ABC
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['OIL001'], 'bom_mstr_qtyper' => 0.8],
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['OIL002'], 'bom_mstr_qtyper' => 0.4],
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['SK0001'], 'bom_mstr_qtyper' => 0.15],

            // Level 2 - Campuran Pewangi (Sama untuk semua FG)
            ['bom_mstr_parent' => $items['CP0001'], 'bom_mstr_child' => $items['PA0001'], 'bom_mstr_qtyper' => 50],
            ['bom_mstr_parent' => $items['CP0001'], 'bom_mstr_child' => $items['PA0002'], 'bom_mstr_qtyper' => 100],
        ];


        foreach ($datas as $data) {
            BomMstr::create(array_merge($data, [
                'bom_mstr_start' => now(),
                'bom_mstr_expire' => null,
                'bom_mstr_status' => 1,
                'bom_mstr_remark' => 'Auto-generated',
                'bom_mstr_cb' => 1,
            ]));
        }
    }
}
