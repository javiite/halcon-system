@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Materiales</h1>
    <a href="{{ route('materiales.create') }}" class="btn btn-primary mb-3">Nuevo Material</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $material)
            <tr>
                <td>{{ $material->nombre }}</td>
                <td>{{ $material->descripcion }}</td>
                <td>
                    <a href="{{ route('materiales.edit', $material) }}" class="btn btn-sm btn-warning">Editar</a>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
