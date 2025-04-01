@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Consulta de Pedido</h1>

    <form method="GET" action="{{ route('buscar.factura') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="factura" class="form-control" placeholder="Ingrese el número de factura..." required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @if(isset($pedido))
        <div class="card mt-4">
            <div class="card-header">
                Resultado para factura #{{ $pedido->numero_factura }}
            </div>
            <div class="card-body">
                <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>

                @if($pedido->estado === 'entregado')
                    <p><strong>Foto de evidencia:</strong></p>
                    @if($pedido->evidencias->isNotEmpty())
                        <img src="{{ asset('storage/' . $pedido->evidencias->first()->foto) }}" width="300">
                    @else
                        <p>No hay evidencia cargada.</p>
                    @endif
                @elseif($pedido->estado === 'proceso')
                    <p><strong>Fecha de pedido:</strong> {{ $pedido->fecha_pedido }}</p>
                @else
                    <p>El pedido está en estado: {{ $pedido->estado }}</p>
                @endif
            </div>
        </div>
    @elseif(request()->has('factura'))
        <div class="alert alert-warning mt-4">
            No se encontró ningún pedido con ese número de factura.
        </div>
    @endif
</div>
@endsection
