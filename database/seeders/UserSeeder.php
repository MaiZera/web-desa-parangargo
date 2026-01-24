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
        // Create Super Admin
        User::create([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'email' => 'superadmin@parangargo.desa.id',
            'password' => Hash::make('password123'),
            'access_level' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // Create Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@parangargo.desa.id',
            'password' => Hash::make('password123'),
            'access_level' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Editor
        User::create([
            'name' => 'Editor Desa',
            'username' => 'editor',
            'email' => 'editor@parangargo.desa.id',
            'password' => Hash::make('password123'),
            'access_level' => 'editor',
            'email_verified_at' => now(),
        ]);
    }
}
