<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@boesman.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@boesman.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}

