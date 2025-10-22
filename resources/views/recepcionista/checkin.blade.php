@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Módulo de Check-In</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    {{-- Formulario de Check-In --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Registrar nuevo Check-In</div>
        <div class="card-body">
            <form method="POST" action="{{ route('checkin.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="idCliente" class="form-label">ID Cliente (UUID)</label>
                    <div class="input-group">
                        <input type="text" name="idCliente" id="idCliente" class="form-control" readonly required>
                        <button type="button" class="btn btn-outline-secondary" onclick="generarUUID()">Generar</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del huésped</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido del huésped</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="documento" class="form-label">Documento de identidad</label>
                    <input type="text" name="documento" id="documento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Número de teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="idHabitacion" class="form-label">Seleccionar habitación</label>
                    <select name="idHabitacion" id="idHabitacion" class="form-select" required>
                        <option value="">-- Seleccione una habitación disponible --</option>
                        @foreach($habitacionesDisponibles as $h)
                            <option value="{{ $h->idHabitacion }}">
                                Nº {{ $h->numero }} - {{ $h->tipoHabitacion }} (Capacidad: {{ $h->capacidad }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fechaEntrada" class="form-label">Fecha de entrada</label>
                    <input type="date" name="fechaEntrada" id="fechaEntrada" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Registrar Check-In</button>
            </form>
        </div>
    </div>

    {{-- Tabla de Check-Ins registrados --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">Check-Ins registrados</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Cliente</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Habitación</th>
                        <th>Fecha de entrada</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checkins as $c)
                        <tr>
                            <td>{{ $c->cliente->idCliente }}</td>
                            <td>{{ $c->cliente->nombre }}</td>
                            <td>{{ $c->cliente->apellido }}</td>
                            <td>{{ $c->cliente->documento }}</td>
                            <td>{{ $c->cliente->telefono }}</td>
                            <td>{{ $c->habitacion->numero ?? 'N/A' }}</td>
                            <td>{{ $c->fechaEntrada }}</td>
                            <td>{{ ucfirst($c->estado) }}</td>
                            <td>
                                <a href="{{ route('checkin.index', ['editar' => $c->idCheckin]) }}" class="btn btn-sm btn-warning">Editar</a>

                                <form action="{{ route('checkin.destroy', ['idCheckin' => $c->idCheckin]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este check-in?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        {{-- Formulario de edición debajo de la fila --}}
                        @if($checkinEdit && $checkinEdit->idCheckin == $c->idCheckin)
                            <tr>
                                <td colspan="9">
                                    <div class="card mb-4 border-warning">
                                        <div class="card-header bg-warning text-dark">Editar Check-In</div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('checkin.update', $checkinEdit->idCheckin) }}">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="idCliente" value="{{ $checkinEdit->cliente->idCliente }}">

                                                <div class="mb-3">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" name="nombre" class="form-control" value="{{ $checkinEdit->cliente->nombre }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Apellido</label>
                                                    <input type="text" name="apellido" class="form-control" value="{{ $checkinEdit->cliente->apellido }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Documento</label>
                                                    <input type="text" name="documento" class="form-control" value="{{ $checkinEdit->cliente->documento }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="text" name="telefono" class="form-control" value="{{ $checkinEdit->cliente->telefono }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Habitación</label>
                                                    <select name="idHabitacion" class="form-select" required>
                                                        {{-- Incluimos la habitación actual aunque no esté disponible --}}
                                                        <option value="{{ $checkinEdit->habitacion->idHabitacion }}" selected>
                                                            Nº {{ $checkinEdit->habitacion->numero }} - {{ $checkinEdit->habitacion->tipoHabitacion }}
                                                        </option>
                                                        @foreach($habitacionesDisponibles as $h)
                                                            @if($h->idHabitacion != $checkinEdit->habitacion->idHabitacion)
                                                                <option value="{{ $h->idHabitacion }}">
                                                                    Nº {{ $h->numero }} - {{ $h->tipoHabitacion }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Fecha de entrada</label>
                                                    <input type="date" name="fechaEntrada" class="form-control" value="{{ $checkinEdit->fechaEntrada }}" required>
                                                </div>

                                                <button type="submit" class="btn btn-warning">Actualizar Check-In</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No hay check-ins registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script para generar UUID --}}
<script>
function generarUUID() {
    const uuid = crypto.randomUUID();
    document.getElementById('idCliente').value = uuid;
}
</script>
@endsection

