<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BomMstr;
use App\Models\ItemMstr;

class BomMstrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemCodes = [
            // Sabun
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
            'CLY001',
            // Nastar
            'NN0001',
            'NST001',
            'TL0001',
            'ADN001',
            'SLN001',
            'TEP001',
            'MNT001',
            'GUL001',
            'SUS001',
            'MAZ001',
            'TEL001',
            'NAN001',
            'GUL002',
        ];

        $items = ItemMstr::whereIn('item_name', $itemCodes)->pluck('item_id', 'item_name');

        $parentItemNames = [
            'SM0001',
            'CM0001',
            'SM0002',
            'CM0002',
            'CP0001',
            'SP001',
            'SP002',
            'SABN01',
            'ADTIV1',
            'BASE01',
            'EXF001',
            'AROMA1',
            'NN0001',
            'NST001',
            'ADN001',
            'SLN001'
        ];
        $parentIds = $items->only($parentItemNames)->values();
        BomMstr::whereIn('bom_mstr_parent', $parentIds)->delete();

        $soapBoms = [
            // Level 1 - Sabun Mandi XYZ
            ['parent' => 'SM0001', 'child' => 'CM0001', 'qty' => 5],
            ['parent' => 'SM0001', 'child' => 'CP0001', 'qty' => 500],
            // Level 2 - Campuran Minyak Sabun XYZ
            ['parent' => 'CM0001', 'child' => 'OIL001', 'qty' => 1],
            ['parent' => 'CM0001', 'child' => 'OIL002', 'qty' => 0.5],
            ['parent' => 'CM0001', 'child' => 'SK0001', 'qty' => 0.2],
            // Level 1 - Sabun Mandi ABC
            ['parent' => 'SM0002', 'child' => 'CM0002', 'qty' => 4],
            ['parent' => 'SM0002', 'child' => 'CP0001', 'qty' => 400],
            // Level 2 - Campuran Minyak Sabun ABC
            ['parent' => 'CM0002', 'child' => 'OIL001', 'qty' => 0.8],
            ['parent' => 'CM0002', 'child' => 'OIL002', 'qty' => 0.4],
            ['parent' => 'CM0002', 'child' => 'SK0001', 'qty' => 0.15],
            // Level 2 - Campuran Pewangi
            ['parent' => 'CP0001', 'child' => 'PA0001', 'qty' => 50],
            ['parent' => 'CP0001', 'child' => 'PA0002', 'qty' => 100],
            // Level 1 - Sabun Premium Lavender (FG)
            ['parent' => 'SP001', 'child' => 'SABN01', 'qty' => 0.1],
            ['parent' => 'SP001', 'child' => 'ADTIV1', 'qty' => 0.02],
            ['parent' => 'SP001', 'child' => 'AROMA1', 'qty' => 5],
            // Level 1 - Sabun Premium Peppermint (FG)
            ['parent' => 'SP002', 'child' => 'SABN01', 'qty' => 0.1],
            ['parent' => 'SP002', 'child' => 'ADTIV1', 'qty' => 0.02],
            ['parent' => 'SP002', 'child' => 'ESS002', 'qty' => 5],
            // Level 2 - Sabun Base Premium
            ['parent' => 'SABN01', 'child' => 'BASE01', 'qty' => 0.8],
            ['parent' => 'SABN01', 'child' => 'GLY001', 'qty' => 0.15],
            ['parent' => 'SABN01', 'child' => 'WTR001', 'qty' => 0.05],
            // Level 2 - Paket Aditif Premium
            ['parent' => 'ADTIV1', 'child' => 'EXF001', 'qty' => 0.6],
            ['parent' => 'ADTIV1', 'child' => 'CLY001', 'qty' => 0.4],
            // Level 3 - Base Sabun Transparan
            ['parent' => 'BASE01', 'child' => 'GLY001', 'qty' => 0.7],
            ['parent' => 'BASE01', 'child' => 'WTR001', 'qty' => 0.3],
            // Level 3 - Eksfolian Alami
            ['parent' => 'EXF001', 'child' => 'CLY001', 'qty' => 0.5],
            ['parent' => 'EXF001', 'child' => 'WTR001', 'qty' => 0.5],
            // Level 3 - Aroma Terapi Lavender
            ['parent' => 'AROMA1', 'child' => 'ESS001', 'qty' => 0.9],
            ['parent' => 'AROMA1', 'child' => 'GLY001', 'qty' => 0.1],
        ];

        $nastarBoms = [
            // BOM untuk 1 Toples Nastar (30 Pcs)
            ['parent' => 'NN0001', 'child' => 'NST001', 'qty' => 30],
            ['parent' => 'NN0001', 'child' => 'TL0001', 'qty' => 1],

            // BOM untuk 1 biji Kue Nastar
            // Untuk 1 pcs kue, butuh 20 gram adonan dan 5 gram selai.
            ['parent' => 'NST001', 'child' => 'ADN001', 'qty' => 0.02],
            ['parent' => 'NST001', 'child' => 'SLN001', 'qty' => 0.005],

            // BOM untuk 1 Kg Adonan Nastar
            ['parent' => 'ADN001', 'child' => 'TEP001', 'qty' => 0.50],  // 500g Tepung
            ['parent' => 'ADN001', 'child' => 'MNT001', 'qty' => 0.25],  // 250g Mentega
            ['parent' => 'ADN001', 'child' => 'GUL001', 'qty' => 0.10],  // 100g Gula Bubuk
            ['parent' => 'ADN001', 'child' => 'SUS001', 'qty' => 0.05],  // 50g Susu Bubuk
            ['parent' => 'ADN001', 'child' => 'MAZ001',  'qty' => 0.05],  // 50g Maizena

            // Untuk membuat 1 Kg adonan, kita butuh 2 butir telur.
            ['parent' => 'ADN001', 'child' => 'TEL001',  'qty' => 2],

            // BOM untuk 1 Kg Selai Nanas
            // Untuk membuat 1 Kg selai, butuh 700g nanas dan 300g gula.
            ['parent' => 'SLN001', 'child' => 'NAN001', 'qty' => 0.7],
            ['parent' => 'SLN001', 'child' => 'GUL002', 'qty' => 0.3],
        ];

        $datas = array_merge($soapBoms, $nastarBoms);

        $bomToInsert = [];
        $now = now();

        foreach ($datas as $data) {
            if (isset($items[$data['parent']]) && isset($items[$data['child']])) {
                $bomToInsert[] = [
                    'bom_mstr_parent' => $items[$data['parent']],
                    'bom_mstr_child' => $items[$data['child']],
                    'bom_mstr_qtyper' => $data['qty'],
                    'bom_mstr_start' => $now,
                    'bom_mstr_expire' => null,
                    'bom_mstr_status' => 1,
                    'bom_mstr_remark' => 'Auto-generated from Seeder',
                    'bom_mstr_cb' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        BomMstr::insert($bomToInsert);
    }
}
