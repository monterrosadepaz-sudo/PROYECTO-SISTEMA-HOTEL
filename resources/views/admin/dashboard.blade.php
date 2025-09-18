@extends('layouts.app')

@section('titulo', 'Panel Administrador')

@section('contenido')
<h2 class="mb-4">Bienvenido, Administrador</h2>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow text-center p-3">
            <h5>Reservas</h5>
            <p>Gestiona todas las reservas</p>
           <!-- boton -->   <a href="/admin/reservas" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3">
            <h5>Habitaciones</h5>
            <p>Controla disponibilidad</p>
          <!-- boton -->    <a href="/admin/habitaciones" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow text-center p-3">
            <h5>Clientes</h5>
            <p>Lista de huéspedes</p>
          <!-- boton -->   <a href="/admin/clientes" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card shadow text-center p-3">
            <h5>Reportes</h5>
            <p>Genera informes</p>
           <!-- boton  -->  <a href="/admin/reportes" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>
@endsection