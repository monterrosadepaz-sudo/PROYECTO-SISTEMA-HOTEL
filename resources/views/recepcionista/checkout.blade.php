@extends('layouts.app')

@section('titulo', 'Check-Out')

@section('contenido')
<h3 class="mb-3">Registrar Check-Out</h3>

<form class="card shadow p-4">
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" placeholder="Nombre del cliente">
        </div>
        <div class="col-md-3">
            <label class="form-label">Habitación</label>
            <select class="form-select">
                <option>101</option>
                <option>102</option>
                <option>103</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha Salida</label>
            <input type="date" class="form-control">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-dark mt-4">Registrar</button>
        </div>
    </div>
</form>
@endsection