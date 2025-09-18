@extends('layouts.app')

@section('titulo', 'Panel Recepcionista')

@section('contenido')
<h2 class="mb-4">Bienvenido, Recepcionista</h2>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Check-In</h5>
            <p>Registrar entrada de huéspedes</p>
            <!-- boton -->  <a href="/recepcionista/checkin" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Check-Out</h5>
            <p>Registrar salida de huéspedes</p>
             <!-- boton --> <a href="/recepcionista/checkout" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Reservas</h5>
            <p>Ver y gestionar reservas</p>
            <!-- boton -->  <a href="/recepcionista/reservas" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection