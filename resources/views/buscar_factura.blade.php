@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Consulta de Pedido por Factura</h1>

    <form action="{{ route('buscar.factura') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="factura" class="form-control" placeholder="Número de factura" required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @isset($pedido)
        <div class="card">
            <div class="card-body">
                <h5>Factura: {{ $pedido->numero_factura }}</h5>
                <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
                <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
                
                @if($pedido->estado === 'Entregado')
                    <p><strong>Evidencia de entrega:</strong></p>
                    @if($pedido->evidencias->where('tipo', 'entrega')->first())
                        <img src="{{ asset('storage/' . $pedido->evidencias->where('tipo', 'entrega')->first()->imagen) }}" width="300" alt="Evidencia de entrega">
                    @else
                        <p>No hay imagen disponible.</p>
                    @endif
                @elseif($pedido->estado === 'En proceso')
                    <p><strong>Proceso:</strong> En proceso</p>
                    <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido }}</p>
                @else
                    <p>Este pedido está en estado: {{ $pedido->estado }}</p>
                @endif
            </div>
        </div>
    @endisset
</div>
@endsection
