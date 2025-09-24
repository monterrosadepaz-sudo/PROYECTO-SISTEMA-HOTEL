@extends('layouts.app')

@section('titulo', 'Check-Out')

@section('contenido')
<h3 class="mb-3">Registrar Check-Out</h3>

<form id="formularioCheckout" method="POST" action="{{ route('checkout.registrar') }}" class="card shadow p-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label for="nombreClienteCheckout" class="form-label">Cliente</label>
            <input type="text" id="nombreClienteCheckout" name="nombreClienteCheckout" class="form-control" placeholder="Nombre del cliente">
        </div>
        <div class="col-md-3">
            <label for="numeroHabitacionCheckout" class="form-label">Habitación</label>
            <select id="numeroHabitacionCheckout" name="numeroHabitacionCheckout" class="form-select">
                <option>101</option>
                <option>102</option>
                <option>103</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="fechaSalidaCheckout" class="form-label">Fecha Salida</label>
            <input type="date" id="fechaSalidaCheckout" name="fechaSalidaCheckout" class="form-control">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" id="btnRegistrarCheckout" name="btnRegistrarCheckout" class="btn btn-dark mt-4">Registrar</button>
        </div>
    </div>
</form>
@endsection