<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InDetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = ['WH-001', 'WH-002', 'STORE-01', 'WIP-AREA-A', 'QC-HOLD'];

        $inventoryData = [];

        for ($itemId = 1; $itemId <= 23; $itemId++) {

            $numberOfLocationsForItem = rand(1, 2);
            $shuffledLocations = $locations;
            shuffle($shuffledLocations);
            $itemLocations = array_slice($shuffledLocations, 0, $numberOfLocationsForItem);

            foreach ($itemLocations as $location) {
                $inventoryData[] = [
                    'in_det_mstr' => $itemId,
                    'in_det_loc'    => $location,
                    'in_det_item'   => $itemId,
                    'in_det_qty'    => rand(5, 999),
                    'in_det_cb'     => 1,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                    'in_det_uuid'   => Str::uuid(),
                ];
            }
        }

        DB::table('in_det')->insert($inventoryData);
    }
}
