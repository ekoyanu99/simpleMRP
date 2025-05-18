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
            'PA0002',
            'SP001',
            'SP002',
            'SABN01',
            'ADTIV1',
            'BASE01',
            'EXF001',
            'AROMA1',
            'GLY001',
            'WTR001',
            'ESS001',
            'ESS002',
            'CLY001'
        ])->pluck('item_mstr_id', 'item_name');

        $datas = [
            // Level 1 - Sabun Mandi XYZ
            ['bom_mstr_parent' => $items['SM0001'], 'bom_mstr_child' => $items['CM0001'], 'bom_mstr_qtyper' => 5],
            ['bom_mstr_parent' => $items['SM0001'], 'bom_mstr_child' => $items['CP0001'], 'bom_mstr_qtyper' => 500],


            // Level 2 - Campuran Minyak Sabun XYZ
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['OIL001'], 'bom_mstr_qtyper' => 1],
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['OIL002'], 'bom_mstr_qtyper' => 0.5],
            ['bom_mstr_parent' => $items['CM0001'], 'bom_mstr_child' => $items['SK0001'], 'bom_mstr_qtyper' => 0.2],


            // Level 1 - Sabun Mandi ABC (FG baru)
            ['bom_mstr_parent' => $items['SM0002'], 'bom_mstr_child' => $items['CM0002'], 'bom_mstr_qtyper' => 4],
            ['bom_mstr_parent' => $items['SM0002'], 'bom_mstr_child' => $items['CP0001'], 'bom_mstr_qtyper' => 400],

            // Level 2 - Campuran Minyak Sabun ABC
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['OIL001'], 'bom_mstr_qtyper' => 0.8],
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['OIL002'], 'bom_mstr_qtyper' => 0.4],
            ['bom_mstr_parent' => $items['CM0002'], 'bom_mstr_child' => $items['SK0001'], 'bom_mstr_qtyper' => 0.15],

            // Level 2 - Campuran Pewangi (Sama untuk semua FG)
            ['bom_mstr_parent' => $items['CP0001'], 'bom_mstr_child' => $items['PA0001'], 'bom_mstr_qtyper' => 50],
            ['bom_mstr_parent' => $items['CP0001'], 'bom_mstr_child' => $items['PA0002'], 'bom_mstr_qtyper' => 100],

            // Level 1 - Sabun Premium Lavender (FG)
            ['bom_mstr_parent' => $items['SP001'], 'bom_mstr_child' => $items['SABN01'], 'bom_mstr_qtyper' => 0.1], // 100g sabun base
            ['bom_mstr_parent' => $items['SP001'], 'bom_mstr_child' => $items['ADTIV1'], 'bom_mstr_qtyper' => 0.02], // 20g aditif
            ['bom_mstr_parent' => $items['SP001'], 'bom_mstr_child' => $items['AROMA1'], 'bom_mstr_qtyper' => 5], // 5ml aroma

            // Level 1 - Sabun Premium Peppermint (FG)
            ['bom_mstr_parent' => $items['SP002'], 'bom_mstr_child' => $items['SABN01'], 'bom_mstr_qtyper' => 0.1],
            ['bom_mstr_parent' => $items['SP002'], 'bom_mstr_child' => $items['ADTIV1'], 'bom_mstr_qtyper' => 0.02],
            ['bom_mstr_parent' => $items['SP002'], 'bom_mstr_child' => $items['ESS002'], 'bom_mstr_qtyper' => 5], // Langsung pakai essential oil

            // Level 2 - Sabun Base Premium
            ['bom_mstr_parent' => $items['SABN01'], 'bom_mstr_child' => $items['BASE01'], 'bom_mstr_qtyper' => 0.8], // 80% base
            ['bom_mstr_parent' => $items['SABN01'], 'bom_mstr_child' => $items['GLY001'], 'bom_mstr_qtyper' => 0.15], // 15% gliserin
            ['bom_mstr_parent' => $items['SABN01'], 'bom_mstr_child' => $items['WTR001'], 'bom_mstr_qtyper' => 0.05], // 5% air

            // Level 2 - Paket Aditif Premium
            ['bom_mstr_parent' => $items['ADTIV1'], 'bom_mstr_child' => $items['EXF001'], 'bom_mstr_qtyper' => 0.6], // 60% eksfolian
            ['bom_mstr_parent' => $items['ADTIV1'], 'bom_mstr_child' => $items['CLY001'], 'bom_mstr_qtyper' => 0.4], // 40% clay

            // Level 3 - Base Sabun Transparan
            ['bom_mstr_parent' => $items['BASE01'], 'bom_mstr_child' => $items['GLY001'], 'bom_mstr_qtyper' => 0.7],
            ['bom_mstr_parent' => $items['BASE01'], 'bom_mstr_child' => $items['WTR001'], 'bom_mstr_qtyper' => 0.3],

            // Level 3 - Eksfolian Alami
            ['bom_mstr_parent' => $items['EXF001'], 'bom_mstr_child' => $items['CLY001'], 'bom_mstr_qtyper' => 0.5],
            ['bom_mstr_parent' => $items['EXF001'], 'bom_mstr_child' => $items['WTR001'], 'bom_mstr_qtyper' => 0.5],

            // Level 3 - Aroma Terapi Lavender
            ['bom_mstr_parent' => $items['AROMA1'], 'bom_mstr_child' => $items['ESS001'], 'bom_mstr_qtyper' => 0.9], // 90% essential oil
            ['bom_mstr_parent' => $items['AROMA1'], 'bom_mstr_child' => $items['GLY001'], 'bom_mstr_qtyper' => 0.1], // 10% gliserin sebagai carrier
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
