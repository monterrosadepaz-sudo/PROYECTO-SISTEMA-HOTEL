@extends('layouts.app')

@section('titulo', 'Panel Administrador')

@section('contenido')
<h2 class="mb-4">Bienvenido, Administrador</h2>

<div class="row g-3">
    
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardHabitaciones">
            <h5>Habitaciones</h5>
            <p>Controla disponibilidad</p>
            <a href="{{ url('/admin/habitaciones') }}" id="btnIrHabitaciones" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardReportes">
            <h5>Reportes</h5>
            <p>Genera informes</p>
            <a href="{{ url('/admin/reportes') }}" id="btnIrReportes" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardUsuarios">
            <h5>Usuarios</h5>
            <p>Controlando cuántos recepcionistas usan este sistema</p>
            <a href="{{ route('usuarios.index') }}" id="btnIrUsuarios" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3" id="cardProducto">
            <h5>Productos</h5>
            <p>Controlando los productos del hotel</p>
            <a href="{{ route('productos.index') }}" id="btnIrProducto" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection
