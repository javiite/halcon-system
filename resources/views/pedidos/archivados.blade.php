@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pedidos Archivados</h1>

    @if($archivados->isEmpty())
        <div class="alert alert-info">
            No hay pedidos archivados.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Factura</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivados as $pedido)
                <tr>
                    <td>{{ $pedido->numero_factura }}</td>
                    <td>{{ $pedido->cliente->nombre }}</td>
                    <td>{{ $pedido->fecha_pedido }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>
                        <form action="{{ route('pedidos.restaurar', $pedido->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection
