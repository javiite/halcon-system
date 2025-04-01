@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Pedidos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pedidos.create') }}" class="btn btn-primary mb-3">Nuevo Pedido</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero_factura }}</td>
                    <td>{{ $pedido->cliente->nombre }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>{{ $pedido->fecha_pedido }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este pedido?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($pedidos->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No hay pedidos registrados.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
