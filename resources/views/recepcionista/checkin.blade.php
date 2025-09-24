@extends('layouts.app')

@section('titulo', 'Check-In')

@section('contenido')
<h3 class="mb-3">Registrar Check-In</h3>

<form id="formularioCheckin" method="POST" action="{{ route('checkin.registrar') }}" class="card shadow p-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label for="nombreClienteCheckin" class="form-label">Cliente</label>
            <input type="text" id="nombreClienteCheckin" name="nombreClienteCheckin" class="form-control" placeholder="Nombre del cliente">
        </div>
        <div class="col-md-3">
            <label for="numeroHabitacionCheckin" class="form-label">Habitación</label>
            <select id="numeroHabitacionCheckin" name="numeroHabitacionCheckin" class="form-select">
                <option>101</option>
                <option>102</option>
                <option>103</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="fechaEntradaCheckin" class="form-label">Fecha Entrada</label>
            <input type="date" id="fechaEntradaCheckin" name="fechaEntradaCheckin" class="form-control">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" id="btnRegistrarCheckin" name="btnRegistrarCheckin" class="btn btn-dark mt-4">Registrar</button>
        </div>
    </div>
</form>
@endsection