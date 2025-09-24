@extends('layouts.app')

@section('titulo', 'Clientes')

@section('contenido')
<h3 class="mb-3">Gestión de Clientes</h3>

<div class="card shadow" id="seccionFormularioCliente">
    <div class="card-header bg-dark text-white">Nuevo Cliente</div>
    <div class="card-body">
        <form id="formularioCliente" class="row g-3" method="POST" action="{{ route('clientes.guardar') }}">
            @csrf
            <div class="col-md-4">
                <label for="nombreCliente" class="form-label">Nombre</label>
                <input type="text" id="nombreCliente" name="nombreCliente" class="form-control" placeholder="Nombre completo">
            </div>
            <div class="col-md-4">
                <label for="correoCliente" class="form-label">Correo</label>
                <input type="email" id="correoCliente" name="correoCliente" class="form-control" placeholder="correo@ejemplo.com">
            </div>
            <div class="col-md-4">
                <label for="telefonoCliente" class="form-label">Teléfono</label>
                <input type="text" id="telefonoCliente" name="telefonoCliente" class="form-control" placeholder="+503 7000-0000">
            </div>
            <div class="col-md-12 d-grid">
                <button type="submit" id="btnGuardarCliente" name="btnGuardarCliente" class="btn btn-dark">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4" id="seccionTablaClientes">
    <h5>Lista de Clientes</h5>
    <table class="table table-hover shadow" id="tablaClientes">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Carlos Pérez</td>
                <td>carlos@mail.com</td>
                <td>7000-1234</td>
                <td>
                    <button type="button" id="btnEditarCliente1" name="btnEditarCliente1" class="btn btn-sm btn-warning">Editar</button>
                    <button type="button" id="btnEliminarCliente1" name="btnEliminarCliente1" class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection