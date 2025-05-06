<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MobilOilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Oil names
        $oilNames = [
            'Mobil 1', 'Mobil Super', 'Mobil Delvac', 'Mobil 0W-40', 'Mobil 1 5W-30',
            'Mobil 1 10W-30', 'Mobil 1 15W-50', 'Mobil 1 Racing', 'Mobil Super 2000'
        ];

        foreach ($oilNames as $name) {
            DB::table('mobil_oils')->insert([
                'name' => $name,
                'saleprice' => $faker->numberBetween(200, 2000), // Random price between 200 and 2000
                'inventory' => $faker->numberBetween(10, 20),   // Random inventory between 10 and 20
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
