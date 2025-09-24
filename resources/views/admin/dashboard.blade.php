@extends('layouts.app')

@section('titulo', 'Panel Administrador')

@section('contenido')
<h2 class="mb-4">Bienvenido, Administrador</h2>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardReservas">
            <h5>Reservas</h5>
            <p>Gestiona todas las reservas</p>
            <a href="/admin/reservas" id="btnIrReservas" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardHabitaciones">
            <h5>Habitaciones</h5>
            <p>Controla disponibilidad</p>
            <a href="/admin/habitaciones" id="btnIrHabitaciones" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardClientes">
            <h5>Clientes</h5>
            <p>Lista de huéspedes</p>
            <a href="/admin/clientes" id="btnIrClientes" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardReportes">
            <h5>Reportes</h5>
            <p>Genera informes</p>
            <a href="/admin/reportes" id="btnIrReportes" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection