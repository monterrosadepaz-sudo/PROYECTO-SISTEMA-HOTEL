@extends('layouts.app')

@section('titulo', 'Habitaciones')

@section('contenido')
<h3 class="mb-3">Gestión de Habitaciones</h3>

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
        ← Volver
    </a>
</div>

{{-- Mensaje de confirmación --}}
@if(session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
@endif



<div class="card shadow" id="seccionFormularioHabitacion">
    <div class="card-header bg-dark text-white">
        {{ isset($habitacion) ? 'Editar Habitación' : 'Nueva Habitación' }}
    </div>
    <div class="card-body">
        <form id="formularioHabitacion" method="POST"
      action="{{ isset($habitacion) ? route('habitaciones.update', $habitacion->idHabitacion) : route('habitaciones.store') }}">
    @csrf
    @if(isset($habitacion))
        @method('PUT')
    @endif

    <div class="col-md-3">
        <label for="numeroHabitacion" class="form-label">Número</label>
        <input type="text" name="numeroHabitacion" id="numeroHabitacion" class="form-control"
               value="{{ old('numeroHabitacion', $habitacion->numero ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label for="tipoHabitacion" class="form-label">Tipo</label>
        <select name="tipoHabitacion" id="tipoHabitacion" class="form-select" required>
            <option value="Sencilla" {{ old('tipoHabitacion', $habitacion->tipoHabitacion ?? '') == 'Sencilla' ? 'selected' : '' }}>Sencilla</option>
            <option value="Doble" {{ old('tipoHabitacion', $habitacion->tipoHabitacion ?? '') == 'Doble' ? 'selected' : '' }}>Doble</option>
            <option value="Suite" {{ old('tipoHabitacion', $habitacion->tipoHabitacion ?? '') == 'Suite' ? 'selected' : '' }}>Suite</option>
        </select>
    </div>

    <div class="col-md-3">
        <label for="precioHabitacion" class="form-label">Precio(24h)</label>
        <input type="number" name="precioHabitacion" id="precioHabitacion" class="form-control"
               value="{{ old('precioHabitacion', $habitacion->precio ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label for="capacidad" class="form-label">Capacidad</label>
        <input type="number" name="capacidad" id="capacidad" class="form-control"
               value="{{ old('capacidad', $habitacion->capacidad ?? '') }}" min="1" required>
    </div>

    <div>
        <br>
        <br>
    </div>

    <div class="col-md-3 d-grid align-self-end">
        <button type="submit" class="btn btn-dark">
            {{ isset($habitacion) ? 'Actualizar' : 'Guardar' }}
        </button>
    </div>
</form>

    </div>
</div>

{{-- Tabla de habitaciones --}}
<div class="mt-4" id="seccionTablaHabitaciones">
    <h5>Lista de Habitaciones</h5>
    <table class="table table-bordered shadow" id="tablaHabitaciones">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio(por 24h)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($habitaciones as $habitacion)
            <tr>
                <td>{{ $habitacion->id }}</td>
                <td>{{ $habitacion->numero }}</td>
                <td>{{ $habitacion->tipo }}</td>
                <td>{{ $habitacion->precio }}</td>
                <td>{{ $habitacion->estado }}</td>
                <td>
                    <a href="{{ route('habitaciones.edit', $habitacion->idHabitacion) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('habitaciones.destroy', ['idHabitacion' => $habitacion->idHabitacion]) }}" method="POST" style="display:inline;">
                     @csrf
                     @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                    <form action="{{ route('habitaciones.eliminarDefinitivo', ['idHabitacion' => $habitacion->idHabitacion]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('¿Eliminar esta habitación permanentemente? Esta acción no se puede deshacer.')">
                        Destruir
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
