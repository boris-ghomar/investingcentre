<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123123123'),
        ]);

        Customer::create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'customer@test.com',
            'password' => Hash::make('123123123'),
            'phone' => '+374-95-10-25-30',
        ]);
    }
}
