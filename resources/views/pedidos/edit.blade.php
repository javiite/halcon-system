@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pedido</h1>

    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Número de Factura</label>
            <input type="text" name="numero_factura" class="form-control" value="{{ $pedido->numero_factura }}" required>
        </div>

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $pedido->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha del Pedido</label>
            <input type="datetime-local" name="fecha_pedido" class="form-control"
                value="{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label>Dirección de Entrega</label>
            <input type="text" name="direccion_entrega" class="form-control" value="{{ $pedido->direccion_entrega }}" required>
        </div>

        <div class="mb-3">
            <label>Estado del Pedido</label>
            <select name="estado" class="form-control" required>
                <option value="En proceso" {{ $pedido->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="En ruta" {{ $pedido->estado == 'En ruta' ? 'selected' : '' }}>En ruta</option>
                <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notas</label>
            <textarea name="notas" class="form-control" rows="3">{{ $pedido->notas }}</textarea>
        </div>

        <hr>
        <h4>Materiales asignados</h4>
        @foreach ($materiales as $material)
            @php
                $cantidad = $pedido->materiales->find($material->id)?->pivot->cantidad ?? 0;
            @endphp
            <div class="mb-2">
                <label>{{ $material->nombre }} (Stock: {{ $material->cantidad_stock }})</label>
                <input type="number" name="materiales[{{ $material->id }}]" class="form-control" value="{{ $cantidad }}" min="0">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Actualizar Pedido</button>
    </form>
</div>
@endsection
