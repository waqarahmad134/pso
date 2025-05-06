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
                'status' => 'active', // Ensure string if your schema expects string
                'fuel_type_id' => $fuelTypeId, // Assign fuel_type_id dynamically
                'last_reading' => rand(5000000, 5999999), // Random value like 5322465
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all the machines into the database
        DB::table('machines')->insert($machines);
    }
}
