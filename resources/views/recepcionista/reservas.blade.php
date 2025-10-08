@extends('layouts.app')

@section('titulo', 'Reservas Recepcionista')

@section('contenido')
<div class="container mt-4">
    <h3 class="mb-4">{{ isset($reservaEdit) ? 'Editar Reserva' : 'Registrar nueva Reserva' }}</h3>

    <form method="POST" action="{{ isset($reservaEdit) ? route('reserva.update', $reservaEdit->idReserva) : route('reserva.store') }}">
        @csrf
        @if(isset($reservaEdit))
            @method('PUT')
        @endif

        <input type="hidden" name="idReserva" id="idReserva" value="{{ old('idReserva', $reservaEdit->idReserva ?? '') }}">

        {{-- UUID Cliente --}}
        <div class="mb-3">
            <label for="idCliente" class="form-label">ID Cliente (UUID)</label>
            <div class="input-group">
                <input type="text" name="idCliente" id="idCliente" class="form-control" value="{{ old('idCliente', $reservaEdit->idCliente ?? '') }}" readonly required>
                <button type="button" class="btn btn-outline-secondary" onclick="generarUUIDCliente()">Generar</button>
            </div>
        </div>

        {{-- Datos del cliente --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $reservaEdit->cliente->nombre ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $reservaEdit->cliente->apellido ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" name="documento" id="documento" class="form-control" value="{{ old('documento', $reservaEdit->cliente->documento ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $reservaEdit->cliente->telefono ?? '') }}">
        </div>

        {{-- Selección de habitación --}}
        <div class="mb-3">
            <label for="idHabitacion" class="form-label">Habitación</label>
            <select name="idHabitacion" id="idHabitacion" class="form-select" required>
                <option value="">-- Seleccione una habitación --</option>
                @isset($habitacionesDisponibles)
                    @foreach($habitacionesDisponibles as $h)
                        <option value="{{ $h->idHabitacion }}"
                            {{ old('idHabitacion', $reservaEdit->idHabitacion ?? '') == $h->idHabitacion ? 'selected' : '' }}>
                            Nº {{ $h->numero }} - {{ $h->tipoHabitacion }} (Capacidad: {{ $h->capacidad }})
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>

        {{-- Fechas de reserva --}}
        <div class="mb-3">
            <label for="fechaEntrada" class="form-label">Fecha de entrada</label>
            <input type="date" name="fechaEntrada" id="fechaEntrada" class="form-control" value="{{ old('fechaEntrada', $reservaEdit->fechaEntrada ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="fechaSalida" class="form-label">Fecha de salida</label>
            <input type="date" name="fechaSalida" id="fechaSalida" class="form-control" value="{{ old('fechaSalida', $reservaEdit->fechaSalida ?? '') }}">
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente" {{ old('estado', $reservaEdit->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ old('estado', $reservaEdit->estado ?? '') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ old('estado', $reservaEdit->estado ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

      

        <button type="submit" class="btn {{ isset($reservaEdit) ? 'btn-warning' : 'btn-success' }}">
            {{ isset($reservaEdit) ? 'Guardar cambios' : 'Registrar Reserva' }}
        </button>
    </form>

    <hr class="my-5">

    <h3 class="mb-3">Reservas registradas</h3>

    <table class="table table-striped shadow">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->cliente->nombre }} {{ $r->cliente->apellido }}</td>
                    <td>{{ $r->habitacion->numero ?? 'N/A' }}</td>
                    <td>{{ $r->fechaEntrada }}</td>
                    <td>{{ $r->fechaSalida ?? '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $r->estado == 'confirmada' ? 'success' : ($r->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($r->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('reserva.edit', $r->idReserva) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('reserva.destroy', $r->idReserva) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta reserva?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay reservas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script para generar UUID --}}
<script>
function generarUUIDCliente() {
    const uuid = crypto.randomUUID();
    document.getElementById('idCliente').value = uuid;
    document.getElementById('idReserva').value = uuid;
}
</script>

@endsection
