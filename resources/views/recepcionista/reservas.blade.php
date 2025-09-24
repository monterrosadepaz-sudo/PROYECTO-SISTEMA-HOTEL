@extends('layouts.app')

@section('titulo', 'Reservas Recepcionista')

@section('contenido')
<h3 class="mb-3">Ver Reservas</h3>

<div id="seccionTablaReservasRecepcionista">
    <table class="table table-striped shadow" id="tablaReservasRecepcionista">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ana López</td>
                <td>101</td>
                <td>2025-09-20</td>
                <td>2025-09-25</td>
                <td><span class="badge bg-success">Confirmada</span></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Carlos Pérez</td>
                <td>102</td>
                <td>2025-09-21</td>
                <td>2025-09-23</td>
                <td><span class="badge bg-warning">Pendiente</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection