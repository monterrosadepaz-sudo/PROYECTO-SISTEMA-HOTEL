@extends('layouts.app')

@section('titulo', 'Panel Recepcionista')

@section('contenido')
<h2 class="mb-4">Bienvenido, Recepcionista</h2>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardCheckin">
            <h5>Check-In</h5>
            <p>Registrar entrada de huéspedes</p>
            <a href="/recepcionista/checkin" id="btnIrCheckin" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardCheckout">
            <h5>Check-Out</h5>
            <p>Registrar salida de huéspedes</p>
            <a href="/recepcionista/checkout" id="btnIrCheckout" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReservasRecepcionista">
            <h5>Reservas</h5>
            <p>Ver y gestionar reservas</p>
            <a href="/recepcionista/reservas" id="btnIrReservasRecepcionista" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection