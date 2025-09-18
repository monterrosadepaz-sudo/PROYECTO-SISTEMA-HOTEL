@extends('layouts.app')

@section('titulo', 'Clientes')

@section('contenido')
<h3 class="mb-3">Gestión de Clientes</h3>

<div class="card shadow">
    <div class="card-header bg-dark text-white">Nuevo Cliente</div>
    <div class="card-body">
        <form class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre completo">
            </div>
            <div class="col-md-4">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" placeholder="correo@ejemplo.com">
            </div>
            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" placeholder="+503 7000-0000">
            </div>
            <div class="col-md-12 d-grid">
                <button class="btn btn-dark">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4">
    <h5>Lista de Clientes</h5>
    <table class="table table-hover shadow">
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
                    <button class="btn btn-sm btn-warning">Editar</button>
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection