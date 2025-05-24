<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FuelsTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('fuels')->insert([
            [
                'name' => 'Petrol',
                'description' => 'High-performance petrol',
                'status' => 'active',
                'price' => 260,
                'fuel_type_id' => 1, 
                'liters' => 0.00,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Diesel',
                'description' => 'Standard diesel from IOCL',
                'status' => 'active',
                'price' => 280,
                'fuel_type_id' => 2, 
                'liters' => 0.00,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
