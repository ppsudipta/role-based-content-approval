<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Author
        User::updateOrCreate(
            ['email' => 'author@test.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('123456'),
                'role' => 'author'
            ]
        );

        // Manager
        User::updateOrCreate(
            ['email' => 'manager@test.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('123456'),
                'role' => 'manager'
            ]
        );

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ]
        );
    }
}