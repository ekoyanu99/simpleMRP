<?php

namespace Database\Seeders;

use App\Models\ItemMstr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemMstrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'item_name' => 'PA0001',
                'item_desc' => 'Pewarna Alami',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'PA0002',
                'item_desc' => 'Pewangi Alami',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'SK0001',
                'item_desc' => 'Soda Kaustik',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'OIL002',
                'item_desc' => 'Minyak Zaitun',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'OIL001',
                'item_desc' => 'Minyak Kelapa',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'CS0001',
                'item_desc' => 'Cetakan Sabun',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'unit',
            ],
            [
                'item_name' => 'CP0001',
                'item_desc' => 'Campuran Pewangi',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'CM0001',
                'item_desc' => 'Campuran Minyak Sabun 01',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'SM0001',
                'item_desc' => 'Sabun Mandi XYZ',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'SM0002',
                'item_desc' => 'Sabun Mandi ABC',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'CM0002',
                'item_desc' => 'Campuran Minyak Sabun 02',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_mstr_cb' => 1,
                'item_uom' => 'l',
            ],

        ];

        foreach ($datas as $data) {
            ItemMstr::create($data);
        }
    }
}
