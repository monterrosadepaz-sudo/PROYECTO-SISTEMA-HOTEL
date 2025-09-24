@extends('layouts.app')

@section('titulo', 'Habitaciones')

@section('contenido')
<h3 class="mb-3">Gestión de Habitaciones</h3>

<div class="card shadow" id="seccionFormularioHabitacion">
    <div class="card-header bg-dark text-white">Nueva Habitación</div>
    <div class="card-body">
        <form id="formularioHabitacion" class="row g-3" method="POST" action="{{ route('habitaciones.guardar') }}">
            @csrf
            <div class="col-md-3">
                <label for="numeroHabitacion" class="form-label">Número</label>
                <input type="text" id="numeroHabitacion" name="numeroHabitacion" class="form-control" placeholder="Ej. 201">
            </div>
            <div class="col-md-3">
                <label for="tipoHabitacion" class="form-label">Tipo</label>
                <select id="tipoHabitacion" name="tipoHabitacion" class="form-select">
                    <option>Sencilla</option>
                    <option>Doble</option>
                    <option>Suite</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="precioHabitacion" class="form-label">Precio</label>
                <input type="number" id="precioHabitacion" name="precioHabitacion" class="form-control" placeholder="$">
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" id="btnGuardarHabitacion" name="btnGuardarHabitacion" class="btn btn-dark mt-4">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4" id="seccionTablaHabitaciones">
    <h5>Lista de Habitaciones</h5>
    <table class="table table-bordered shadow" id="tablaHabitaciones">
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
                    <button type="button" id="btnEditarHabitacion1" name="btnEditarHabitacion1" class="btn btn-sm btn-warning">Editar</button>
                    <button type="button" id="btnEliminarHabitacion1" name="btnEliminarHabitacion1" class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection