<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Crear usuario normal
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@usuario.com',
            'password' => Hash::make('12345678'),
            'role' => 'usuario',
        ]);
    }
}