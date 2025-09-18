@extends('layouts.app')

@section('titulo', 'Reservas')

@section('contenido')
<h3 class="mb-3">Gestión de Reservas</h3>

<div class="card shadow">
    <div class="card-header bg-dark text-white">Nueva Reserva</div>
    <div class="card-body">
        <form>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cliente</label>
                    <input type="text" class="form-control" placeholder="Nombre del cliente">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Habitación</label>
                    <select class="form-select">
                        <option>101</option>
                        <option>102</option>
                        <option>103</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Entrada</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Salida</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-1 d-grid">
                <!-- boton -->      <button class="btn btn-dark mt-4">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="mt-4">
    <h5>Reservas existentes</h5>
    <table class="table table-striped shadow">
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
                  <!-- boton -->    <button class="btn btn-sm btn-warning">Editar</button>
                   <!-- boton -->   <button class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection