@extends('layouts.app')

@section('titulo', 'Reservas')

@section('contenido')
<h3 class="mb-3">Gestión de Reservas</h3>

<div class="card shadow" id="seccionFormularioReserva">
    <div class="card-header bg-dark text-white">Nueva Reserva</div>
    <div class="card-body">
        <form id="formularioReserva" method="POST" action="#">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="nombreClienteReserva" class="form-label">Cliente</label>
                    <input type="text" id="nombreClienteReserva" name="nombreClienteReserva" class="form-control" placeholder="Nombre del cliente">
                </div>
                <div class="col-md-3">
                    <label for="numeroHabitacionReserva" class="form-label">Habitación</label>
                    <select id="numeroHabitacionReserva" name="numeroHabitacionReserva" class="form-select">
                        <option>101</option>
                        <option>102</option>
                        <option>103</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="fechaEntradaReserva" class="form-label">Entrada</label>
                    <input type="date" id="fechaEntradaReserva" name="fechaEntradaReserva" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="fechaSalidaReserva" class="form-label">Salida</label>
                    <input type="date" id="fechaSalidaReserva" name="fechaSalidaReserva" class="form-control">
                </div>
                <div class="col-md-1 d-grid">
                    <button type="submit" id="btnGuardarReserva" name="btnGuardarReserva" class="btn btn-dark mt-4">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="mt-4" id="seccionTablaReservas">
    <h5>Reservas existentes</h5>
    <table class="table table-striped shadow" id="tablaReservas">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ana López</td>
                <td>101</td>
                <td>2025-09-20</td>
                <td>2025-09-25</td>
                <td>
                    <button type="button" id="btnEditarReserva1" name="btnEditarReserva1" class="btn btn-sm btn-warning">Editar</button>
                    <button type="button" id="btnEliminarReserva1" name="btnEliminarReserva1" class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection