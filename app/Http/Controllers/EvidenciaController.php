<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evidencia;
use App\Models\Pedido;

class EvidenciaController extends Controller
{
    public function store(Request $request, $pedidoId)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tipo' => 'required|in:ruta,entrega',
        ]);

        $pedido = Pedido::findOrFail($pedidoId);

        // Guardar imagen en storage
        $ruta = $request->file('imagen')->store('evidencias', 'public');

        // Crear evidencia
        Evidencia::create([
            'pedido_id' => $pedido->id,
            'tipo' => $request->tipo,
            'imagen' => $ruta,
        ]);

        return back()->with('success', 'Evidencia subida correctamente.');
    }
}
