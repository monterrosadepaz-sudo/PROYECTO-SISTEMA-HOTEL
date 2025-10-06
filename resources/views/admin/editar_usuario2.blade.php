@extends('layouts.app')

@section('titulo', 'Editar Usuario')

@section('contenido')
<h3 class="mb-3">Editar Usuario</h3>

<div class="card shadow mb-4">
    <div class="card-header bg-warning text-dark">Formulario de Edición</div>
    <div class="card-body">
        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label for="nombreUsuario" class="form-label">Nombre</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control"
                       placeholder="Nombre completo"
                       value="{{ old('nombreUsuario', $usuario->nombre) }}">
            </div>

            <div class="col-md-6">
                <label for="correoUsuario" class="form-label">Correo</label>
                <input type="email" id="correoUsuario" name="correoUsuario" class="form-control"
                       placeholder="correo@ejemplo.com"
                       value="{{ old('correoUsuario', $usuario->correo) }}">
            </div>

            <div class="col-md-4">
                <label for="rolUsuario" class="form-label">Rol</label>
                <select id="rolUsuario" name="rolUsuario" class="form-select">
                    <option value="administrador" {{ $usuario->rol == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="recepcionista" {{ $usuario->rol == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="estadoUsuario" class="form-label">Estado</label>
                <select id="estadoUsuario" name="estadoUsuario" class="form-select">
                    <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $usuario->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="col-md-4 d-grid align-self-end">
                <button type="submit" class="btn btn-warning">Actualizar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-2">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
