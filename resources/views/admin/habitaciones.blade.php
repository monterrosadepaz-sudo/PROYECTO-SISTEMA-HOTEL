@extends('layouts.app')

@section('titulo', 'Habitaciones')

@section('contenido')
<h3 class="mb-3">Gestión de Habitaciones</h3>

<div class="card shadow">
    <div class="card-header bg-dark text-white">Nueva Habitación</div>
    <div class="card-body">
        <form class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Número</label>
                <input type="text" class="form-control" placeholder="Ej. 201">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select class="form-select">
                    <option>Sencilla</option>
                    <option>Doble</option>
                    <option>Suite</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Precio</label>
                <input type="number" class="form-control" placeholder="$">
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-dark mt-4">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4">
    <h5>Lista de Habitaciones</h5>
    <table class="table table-bordered shadow">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>201</td>
                <td>Doble</td>
                <td>$50</td>
                <td>Disponible</td>
                <td>
                    <button class="btn btn-sm btn-warning">Editar</button>
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection