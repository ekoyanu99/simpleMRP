<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalesMstrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allSalesData = [];
        $faker = \Faker\Factory::create('id_ID');

        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {

            $currentDate = Carbon::today()->subDays($daysAgo);

            $numberOfSalesToday = rand(0, 15);

            for ($i = 0; $i < $numberOfSalesToday; $i++) {

                $allSalesData[] = [
                    'sales_mstr_uuid'     => Str::uuid(),
                    'sales_mstr_nbr'      => 'SO-' . $currentDate->format('ymd') . '-' . Str::padLeft($i + 1, 4, '0'),
                    'sales_mstr_bill'     => $faker->company,
                    'sales_mstr_ship'     => $faker->address,
                    'sales_mstr_date'     => $currentDate,
                    'sales_mstr_due_date' => $currentDate->copy()->addDays(14),
                    'sales_mstr_status'   => '1',
                    'sales_mstr_total'    => $faker->randomFloat(2, 500000, 10000000),
                    'sales_mstr_cb'       => 1,
                    'created_at'          => $currentDate,
                    'updated_at'          => $currentDate,
                ];
            }
        }

        DB::table('sales_mstr')->insert($allSalesData);
    }
}
