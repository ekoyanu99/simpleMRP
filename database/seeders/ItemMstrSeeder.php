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
                'item_cb' => 1,
                'item_uom' => 'ml',
                'item_spec' =>  [
                    'color' => 'red',
                    'solubility' => 'water',
                ],
            ],
            [
                'item_name' => 'PA0002',
                'item_desc' => 'Pewangi Alami',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'ml',
                'item_spec' => [
                    'color' => 'blue',
                    'solubility' => 'oil',
                ],
            ],
            [
                'item_name' => 'SK0001',
                'item_desc' => 'Soda Kaustik',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'OIL002',
                'item_desc' => 'Minyak Zaitun',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'OIL001',
                'item_desc' => 'Minyak Kelapa',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'CS0001',
                'item_desc' => 'Cetakan Sabun',
                'item_pmcode' => 'P',
                'item_prod_line' => 'SUP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'unit',
            ],
            [
                'item_name' => 'CP0001',
                'item_desc' => 'Campuran Pewangi',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'CM0001',
                'item_desc' => 'Campuran Minyak Sabun 01',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'SM0001',
                'item_desc' => 'Sabun Mandi XYZ',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'SM0002',
                'item_desc' => 'Sabun Mandi ABC',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'CM0002',
                'item_desc' => 'Campuran Minyak Sabun 02',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            // Level 4 - Bahan Baku Paling Dasar
            [
                'item_name' => 'GLY001',
                'item_desc' => 'Gliserin',
                'item_pmcode' => 'P',
                'item_prod_line' => 'RAW',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'WTR001',
                'item_desc' => 'Air Demineral',
                'item_pmcode' => 'P',
                'item_prod_line' => 'RAW',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'l',
            ],
            [
                'item_name' => 'ESS001',
                'item_desc' => 'Essential Oil Lavender',
                'item_pmcode' => 'P',
                'item_prod_line' => 'RAW',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'ESS002',
                'item_desc' => 'Essential Oil Peppermint',
                'item_pmcode' => 'P',
                'item_prod_line' => 'RAW',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'ml',
            ],
            [
                'item_name' => 'CLY001',
                'item_desc' => 'Clay Bentonite',
                'item_pmcode' => 'P',
                'item_prod_line' => 'RAW',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],

            // Level 3 - Komponen Intermediate
            [
                'item_name' => 'BASE01',
                'item_desc' => 'Base Sabun Transparan',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'EXF001',
                'item_desc' => 'Eksfolian Alami',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'AROMA1',
                'item_desc' => 'Aroma Terapi Lavender',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'ml',
            ],

            // Level 2 - Sub-Assembly
            [
                'item_name' => 'SABN01',
                'item_desc' => 'Sabun Base Premium',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],
            [
                'item_name' => 'ADTIV1',
                'item_desc' => 'Paket Aditif Premium',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'kg',
            ],

            // Level 1 - Finished Goods
            [
                'item_name' => 'SP001',
                'item_desc' => 'Sabun Premium Lavender',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'unit',
            ],
            [
                'item_name' => 'SP002',
                'item_desc' => 'Sabun Premium Peppermint',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_rjrate' => '0',
                'item_status' => 1,
                'item_cb' => 1,
                'item_uom' => 'unit',
            ],

            // KUE NASTAR 500 gr
            [
                'item_name' => 'NN0001',
                'item_desc' => 'Kue Nastar Nanas Toples 500gr',
                'item_pmcode' => 'M',
                'item_prod_line' => 'FG',
                'item_uom' => 'Pcs',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],

            // Level 1 - Komponen Produk Jadi
            [
                'item_name' => 'NST001',
                'item_desc' => 'Kue Nastar Satuan',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_uom' => 'Pcs',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'TL0001',
                'item_desc' => 'Toples Plastik Ukuran 500gr',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Pcs',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],

            // Level 2 - Komponen WIP
            [
                'item_name' => 'ADN001',
                'item_desc' => 'Adonan Kue Nastar',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'SLN001',
                'item_desc' => 'Selai Nanas Isian',
                'item_pmcode' => 'M',
                'item_prod_line' => 'WIP',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],

            // Level 3 - Bahan Baku (Supporting Materials)
            [
                'item_name' => 'TEP001',
                'item_desc' => 'Tepung Terigu',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'MNT001',
                'item_desc' => 'Mentega',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'GUL001',
                'item_desc' => 'Gula Bubuk / Icing Sugar',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'SUS001',
                'item_desc' => 'Susu Bubuk',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'MAZ001',
                'item_desc' => 'Tepung Maizena',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'TEL001',
                'item_desc' => 'Telur Ayam',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Butir',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'NAN001',
                'item_desc' => 'Nanas Kupas',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],
            [
                'item_name' => 'GUL002',
                'item_desc' => 'Gula Pasir',
                'item_pmcode' => 'P',
                'item_prod_line' => 'Supporting',
                'item_uom' => 'Kg',
                'item_rjrate' => 0,
                'item_status' => 1,
                'item_cb' => 1,
            ],

        ];

        foreach ($datas as $data) {
            ItemMstr::create($data);
        }
    }
}
