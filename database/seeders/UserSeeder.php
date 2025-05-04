<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'contact' => '03001234567',
            'address' => 'Lahore, Pakistan',
            'usertype' => 'admin',
        ]);

        // 10 Customers
        User::factory(10)->create([
            'usertype' => 'customer',
        ]);

        // 10 Staff
        User::factory(10)->create([
            'usertype' => 'staff',
        ]);

        // 10 Suppliers
        User::factory(10)->create([
            'usertype' => 'supplier',
        ]);
    }
}
