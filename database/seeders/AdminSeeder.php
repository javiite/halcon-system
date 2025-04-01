<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Crear rol si no existe
        $adminRol = Rol::firstOrCreate(['nombre' => 'Administración']);

        // Crear usuario admin
        User::firstOrCreate(
            ['email' => 'admin@halcon.com'],
            [
                'name' => 'Admin Halcon',
                'password' => Hash::make('admin123'),
                'rol_id' => $adminRol->id,
                'status' => true,
            ]
        );
    }
}
