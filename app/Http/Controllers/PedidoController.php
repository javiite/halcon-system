<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Material;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cliente')->latest()->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $materiales = Material::all();

        return view('pedidos.create', compact('clientes', 'materiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'estado' => 'required',
            'numero_factura' => 'required|unique:pedidos,numero_factura',
        ]);

        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'user_id' => auth()->id(), // usuario logueado
            'estado' => $request->estado,
            'numero_factura' => $request->numero_factura,
            'fecha_pedido' => now(),
            'direccion_entrega' => $request->direccion_entrega,
            'notas' => $request->notas,
        ]);

        // Asociar materiales
        if ($request->has('materiales')) {
            foreach ($request->materiales as $material_id => $cantidad) {
                if ($cantidad > 0) {
                    $pedido->materiales()->attach($material_id, ['cantidad' => $cantidad]);
                }
            }
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
    }

    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'materiales', 'evidencias'])->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::with('materiales')->findOrFail($id);
        $clientes = Cliente::all();
        $materiales = Material::all();
        return view('pedidos.edit', compact('pedido', 'clientes', 'materiales'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->update([
            'cliente_id' => $request->cliente_id,
            'estado' => $request->estado,
            'numero_factura' => $request->numero_factura,
        ]);

        if ($request->has('materiales')) {
            $materiales = [];
            foreach ($request->materiales as $material_id => $cantidad) {
                if ($cantidad > 0) {
                    $materiales[$material_id] = ['cantidad' => $cantidad];
                }
            }
            $pedido->materiales()->sync($materiales); // actualiza materiales
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete(); // opcionalmente puedes hacer softDelete
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado');
    }

    public function buscarFactura(Request $request)
    {
        $pedido = null;

        if ($request->has('factura')) {
            $pedido = Pedido::with(['cliente', 'evidencias'])->where('numero_factura', $request->factura)->first();
        }

        return view('buscar_factura', compact('pedido'));
    }
}
