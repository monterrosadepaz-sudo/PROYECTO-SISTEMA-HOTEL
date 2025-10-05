@extends('layouts.app')

@section('titulo', 'Gestión de Usuarios')

@section('contenido')
<h3 class="mb-3">Gestión de Usuarios</h3>

<div class="card shadow mb-4" id="seccionFormularioUsuario">
    <div class="card-header bg-dark text-white">Nuevo / Editar Usuario</div>
    <div class="card-body">
        <form id="formularioUsuario" class="row g-3" method="POST" action=" {{ route('usuarios.store') }}">
            @csrf
            @method('POST') 
            
            <div class="col-md-6">
                <label for="nombreUsuario" class="form-label">Nombre</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" placeholder="Nombre completo">
            </div>

            <div class="col-md-6">
                <label for="correoUsuario" class="form-label">Correo</label>
                <input type="email" id="correoUsuario" name="correoUsuario" class="form-control" placeholder="correo@ejemplo.com">
            </div>

            <div class="col-md-4">
                <label for="rolUsuario" class="form-label">Rol</label>
                <select id="rolUsuario" name="rolUsuario" class="form-select">
                    <option value="admin">Administrador</option>
                    <option value="recepcionista">Recepcionista</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="estadoUsuario" class="form-label">Estado</label>
                <select id="estadoUsuario" name="estadoUsuario" class="form-select">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <div class="col-md-4 d-grid align-self-end">
                <button type="submit" id="btnGuardarUsuario" name="btnGuardarUsuario" class="btn btn-dark">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow" id="seccionTablaUsuarios">
    <div class="card-header bg-secondary text-white">Lista de Usuarios</div>
    <div class="card-body">
        <table class="table table-hover" id="tablaUsuarios">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>juan@mail.com</td>
                    <td>Administrador</td>
                    <td>Activo</td>
                    <td>
                        <button type="button" id="btnEditarUsuario1" name="btnEditarUsuario1" class="btn btn-sm btn-warning">Editar</button>
                        <button type="button" id="btnEliminarUsuario1" name="btnEliminarUsuario1" class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

