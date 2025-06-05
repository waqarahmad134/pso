<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpensesTableSeeder extends Seeder
{
    public function run()
    {
        $accountHeads = [
            'Cost of sales',
            'Rent',
            'Advertising expenses',
            'Depreciation expense',
            'Extraordinary expenses',
            'Operating expenses',
            'Insurance',
            'Utilities expense',
            'Bank fees',
            'Equipment maintenance',
            'Interest expense',
            'Fixed expenses',
            'Taxes',
            'Administrative expenses',
            'Salaries',
            'Supplies expense',
            'Training and development',
            'Travel expenses',
            'PSO Reward',
        ];

        $now = Carbon::now();

        foreach ($accountHeads as $head) {
            DB::table('expenses')->insert([
                'name' => $head,
                'description' => $head . ' related expense.',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
