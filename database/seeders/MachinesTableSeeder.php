<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachinesTableSeeder extends Seeder
{
    public function run()
    {
        $machines = [];
        
        // Fetch fuel type IDs
        $fuelTypeId1 = 1;
        $fuelTypeId2 = 2;

        for ($i = 1; $i <= 10; $i++) {
            // Half will have fuel_type_id 1, half will have fuel_type_id 2
            $fuelTypeId = ($i <= 5) ? $fuelTypeId1 : $fuelTypeId2;

            $machines[] = [
                'name' => 'Machine ' . $i,
                'status' => 'active', 
                'fuel_id' => $fuelTypeId,
                'fuel_type_id' => $fuelTypeId,
                'last_reading' => rand(5000000, 5999999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all the machines into the database
        DB::table('machines')->insert($machines);
    }
}
