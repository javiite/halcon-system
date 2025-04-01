@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $usuario->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol_id" class="form-control" required>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Estatus</label>
            <select name="status" class="form-control">
                <option value="1" {{ $usuario->status ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$usuario->status ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
