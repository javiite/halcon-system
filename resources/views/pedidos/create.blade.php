@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Pedido</h1>

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Número de Factura</label>
            <input type="text" name="numero_factura" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha del Pedido</label>
            <input type="datetime-local" name="fecha_pedido" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label>Dirección de Entrega</label>
            <input type="text" name="direccion_entrega" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estado del Pedido</label>
            <select name="estado" class="form-control" required>
                <option value="En proceso">En proceso</option>
                <option value="En ruta">En ruta</option>
                <option value="Entregado">Entregado</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notas</label>
            <textarea name="notas" class="form-control" rows="3"></textarea>
        </div>

        <hr>
        <h4>Materiales</h4>

        @foreach ($materiales as $material)
            <div class="mb-2">
                <label>{{ $material->nombre }} (Stock: {{ $material->cantidad_stock }})</label>
                <input type="number" name="materiales[{{ $material->id }}]" class="form-control" value="0" min="0">
            </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Guardar Pedido</button>
    </form>
</div>
@endsection
