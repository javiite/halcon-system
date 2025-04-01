<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\User;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $cliente = Cliente::first();
        $usuario = User::first(); // asegúrate de tener un usuario creado

        if (!$cliente || !$usuario) {
            dump('Necesitas al menos un cliente y un usuario en la base de datos.');
            return;
        }

        // Crear materiales si no existen
        $material1 = Material::firstOrCreate(['nombre' => 'Ladrillo'], ['cantidad_stock' => 100]);
        $material2 = Material::firstOrCreate(['nombre' => 'Cemento'], ['cantidad_stock' => 50]);

        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'user_id' => $usuario->id,
            'estado' => 'en_proceso',
            'numero_factura' => 'F001',
            'fecha_pedido' => now(),
            'direccion_entrega' => 'Obra Torreón Centro',
            'notas' => 'Entrega urgente',
        ]);

        // Asociar materiales al pedido
        $pedido->materiales()->attach([
            $material1->id => ['cantidad' => 20],
            $material2->id => ['cantidad' => 10],
        ]);
    }
}
