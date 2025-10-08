@extends('layouts.app')

@section('titulo', 'Panel Recepcionista')

@section('contenido')
<h2 class="mb-4">Bienvenido, Recepcionista</h2>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardCheckin">
            <h5>Check-In</h5>
            <p>Registrar entrada de huéspedes</p>
            <a href="{{ route('checkin.index') }}" class="btn btn-dark">Ir al Check-In</a>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardCheckout">
            <h5>Check-Out</h5>
            <p>Registrar salida de huéspedes</p>
            <a href="{{ route('checkout.index') }}" id="btnIrCheckout" class="btn btn-sm btn-dark">Ir al Check-Out</a>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReservasRecepcionista">
            <h5>Reservas</h5>
            <p>Ver y gestionar reservas</p>
            <a href="{{ route('reserva.index') }}" id="btnIrReservasRecepcionista" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection