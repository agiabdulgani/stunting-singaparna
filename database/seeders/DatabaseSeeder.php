<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'wilayah' => null,
        ]);

        // Akun Operator Kecamatan
        User::create([
            'name' => 'Operator Kecamatan',
            'email' => 'operator.kecamatan@example.com',
            'password' => Hash::make('password'),
            'role' => 'operator_kecamatan',
            'wilayah' => 'Singaparna',
        ]);

        // Akun Operator Desa
        User::create([
            'name' => 'Operator Desa',
            'email' => 'operator.desa@example.com',
            'password' => Hash::make('password'),
            'role' => 'operator_desa',
            'wilayah' => 'Singaparna',
        ]);
    }
}