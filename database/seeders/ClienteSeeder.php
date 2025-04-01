<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'numero_cliente' => 'C001',
            'nombre' => 'Cliente de Prueba',
            'telefono' => '8711234567',
            'direccion' => 'Av. Siempre Viva 742',
        ]);
    }
}
