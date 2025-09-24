@extends('layouts.app')

@section('titulo', 'Reportes')

@section('contenido')
<h3 class="mb-3">Reportes del Hotel</h3>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteOcupacion">
            <h5>Ocupación</h5>
            <p>Ver ocupación de habitaciones</p>
            <button type="button" id="btnGenerarReporteOcupacion" name="btnGenerarReporteOcupacion" class="btn btn-dark">Generar</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteIngresos">
            <h5>Ingresos</h5>
            <p>Reporte de ingresos por reservas</p>
            <button type="button" id="btnGenerarReporteIngresos" name="btnGenerarReporteIngresos" class="btn btn-dark">Generar</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteClientes">
            <h5>Clientes</h5>
            <p>Historial de huéspedes</p>
            <button type="button" id="btnGenerarReporteClientes" name="btnGenerarReporteClientes" class="btn btn-dark">Generar</button>
        </div>
    </div>
</div>
@endsection