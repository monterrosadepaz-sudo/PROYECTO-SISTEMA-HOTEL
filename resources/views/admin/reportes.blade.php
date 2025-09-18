@extends('layouts.app')

@section('titulo', 'Reportes')

@section('contenido')
<h3 class="mb-3">Reportes del Hotel</h3>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Ocupación</h5>
            <p>Ver ocupación de habitaciones</p>
            <button class="btn btn-dark">Generar</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Ingresos</h5>
            <p>Reporte de ingresos por reservas</p>
            <button class="btn btn-dark">Generar</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Clientes</h5>
            <p>Historial de huéspedes</p>
            <button class="btn btn-dark">Generar</button>
        </div>
    </div>
</div>
@endsection