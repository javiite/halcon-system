@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Pedido</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Factura:</strong> {{ $pedido->numero_factura }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
            <p><strong>Fecha del pedido:</strong> {{ $pedido->fecha_pedido }}</p>
            <p><strong>Dirección de entrega:</strong> {{ $pedido->direccion_entrega }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
            @if($pedido->notas)
                <p><strong>Notas:</strong> {{ $pedido->notas }}</p>
            @endif
        </div>
    </div>

    <h4>Materiales asignados</h4>
    @if($pedido->materiales->count())
        <ul class="list-group mb-4">
            @foreach ($pedido->materiales as $material)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $material->nombre }}</span>
                    <span>Cantidad: {{ $material->pivot->cantidad }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p>No se han asignado materiales a este pedido.</p>
    @endif

    <h4>Evidencias</h4>
    @if($pedido->evidencias->count())
        <div class="row mb-4">
            @foreach($pedido->evidencias as $evidencia)
                <div class="col-md-4 mb-3">
                    <p><strong>{{ ucfirst($evidencia->tipo) }}</strong></p>
                    <img src="{{ asset('storage/' . $evidencia->imagen) }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    @else
        <p>No hay evidencias registradas.</p>
    @endif

    @if(in_array($pedido->estado, ['En ruta', 'Entregado']))
        <h4>Subir evidencia</h4>
        <form action="{{ route('evidencias.store', $pedido->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Tipo de evidencia</label>
                <select name="tipo" class="form-control" required>
                    <option value="ruta">Ruta</option>
                    <option value="entrega">Entrega</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="imagen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir</button>
        </form>
    @endif
</div>
@endsection
