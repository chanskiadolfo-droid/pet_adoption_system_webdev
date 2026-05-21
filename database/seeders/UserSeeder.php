<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'rianelle@gmail.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('elle09'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Shelter Staff',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        User::updateOrCreate(
            ['email' => 'adopter@gmail.com'],
            [
                'name' => 'Pet Adopter',
                'password' => Hash::make('password'),
                'role' => 'adopter',
            ]
        );
    }
}
