@extends('layouts.app')

@section('titulo', 'Reportes')

@section('contenido')
<h3 class="mb-3">Reportes del Hotel</h3>

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
        ← Volver
    </a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteOcupacion">
            <h5>Ocupación</h5>
            <p>Ver ocupación de habitaciones</p>
            <a href="{{ route('reporte.habitaciones') }}" class="btn btn-dark">
                Generar
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteIngresos">
            <h5>Ingresos</h5>
            <p>Reporte de ingresos por reservas</p>
            <a href="{{ route('admin.reporte.ingresos') }}"  
                class="btn btn-dark">
                Generar
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3" id="cardReporteClientes">
        <h5>Clientes</h5>
        <p>Historial de huéspedes</p>
        <a href="{{ route('admin.reportes.clientes') }}" class="btn btn-dark">
         Generar
        </a>
    </div>

    </div>
</div>
@endsection