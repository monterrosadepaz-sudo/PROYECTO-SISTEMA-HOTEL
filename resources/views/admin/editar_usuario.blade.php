@extends('layouts.app')

@section('titulo', 'Gestión de Usuarios')

@section('contenido')
<h3 class="mb-3">Gestión de Usuarios</h3>
<p>Total usuarios: {{ count($usuarios) }}</p>

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
        ← Volver
    </a>
</div>


<div class="card shadow mb-4" id="seccionFormularioUsuario">
    <div class="card-header bg-dark text-white">Nuevo Usuario</div>
    <div class="card-body">
        <form id="formularioUsuario" class="row g-3" method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombreUsuario" class="form-label">Nombre</label>
                    <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control"
                           placeholder="Nombre completo" value="{{ old('nombreUsuario') }}">
                </div>

                <div class="col-md-6">
                    <label for="correoUsuario" class="form-label">Correo</label>
                    <input type="email" id="correoUsuario" name="correoUsuario" class="form-control"
                           placeholder="correo@ejemplo.com" value="{{ old('correoUsuario') }}">
                </div>

                <div class="col-md-6">
                    <label for="contrasenha" class="form-label">Contraseña</label>
                    <input type="password" name="contrasenha" id="contrasenha" class="form-control"
                           placeholder="••••••••" value="{{ old('contrasenha') }}">
                </div>

                <div class="col-md-4">
                    <label for="rolUsuario" class="form-label">Rol</label>
                    <select id="rolUsuario" name="rolUsuario" class="form-select">
                        <option value="administrador" {{ old('rolUsuario') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="recepcionista" {{ old('rolUsuario') == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="estadoUsuario" class="form-label">Estado</label>
                    <select id="estadoUsuario" name="estadoUsuario" class="form-select">
                        <option value="activo" {{ old('estadoUsuario') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estadoUsuario') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="col-md-4 d-grid align-self-end">
                    <button type="submit" id="btnGuardarUsuario" name="btnGuardarUsuario" class="btn btn-dark">
                        Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow" id="seccionTablaUsuarios">
    <div class="card-header bg-secondary text-white">Lista de Usuarios</div>
    <div class="card-body p-4">
    <div class="table-responsive">
        <table class="table table-hover" id="tablaUsuarios">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td class="text-truncate" style="max-width: 200px;">{{ $usuario->correo }}</td>
                    <td>••••••••</td>
                    <td>{{ ucfirst($usuario->rol) }}</td>
                    <td>{{ ucfirst($usuario->estado) }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


