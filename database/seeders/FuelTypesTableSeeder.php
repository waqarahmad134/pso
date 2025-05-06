<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FuelTypesTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('fuel_types')->insert([
            ['name' => 'Petrol', 'description' => 'Petrol', 'price' => 260, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Diesel', 'description' => 'Diesel', 'price' => 280, 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}
