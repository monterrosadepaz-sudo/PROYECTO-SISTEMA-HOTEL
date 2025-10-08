@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Módulo de Check-In</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Estado de habitaciones --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Estado de habitaciones</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Total registradas: <strong>{{ $total }}</strong></li>
                <li class="list-group-item">Ocupadas: <strong>{{ $ocupadas }}</strong></li>
                <li class="list-group-item">Disponibles: <strong>{{ $disponibles }}</strong></li>
            </ul>
        </div>
    </div>

    {{-- Listado de habitaciones --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">Habitaciones disponibles</div>
                <ul class="list-group list-group-flush">
                    @forelse($habitacionesDisponibles as $h)
                        <li class="list-group-item">
                            Nº {{ $h->numero }} - {{ $h->tipoHabitacion }} (Capacidad: {{ $h->capacidad }}) - ${{ number_format($h->precio, 2) }}
                        </li>
                    @empty
                        <li class="list-group-item text-danger">No hay habitaciones disponibles</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">Habitaciones ocupadas</div>
                <ul class="list-group list-group-flush">
                    @forelse($habitacionesOcupadas as $h)
                        <li class="list-group-item">
                            Nº {{ $h->numero }} - {{ $h->tipoHabitacion }} (Capacidad: {{ $h->capacidad }}) - ${{ number_format($h->precio, 2) }}
                        </li>
                    @empty
                        <li class="list-group-item text-success">No hay habitaciones ocupadas</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

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
                    <label for="habitacion_id" class="form-label">Seleccionar habitación</label>
                    <select name="habitacion_id" id="habitacion_id" class="form-select" required>
                        <option value="">-- Seleccione una habitación disponible --</option>
                        @foreach($habitacionesDisponibles as $h)
                            <option value="{{ $h->idHabitacion }}">
                                Nº {{ $h->numero }} - {{ $h->tipoHabitacion }} (Capacidad: {{ $h->capacidad }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha_entrada" class="form-label">Fecha de entrada</label>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" required>
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
                                <button type="button" class="btn btn-sm btn-warning" onclick="mostrarFormulario('{{ $c->idReserva }}')">Editar</button>

                                <form action="{{ route('checkin.destroy', ['id' => $c->idReserva]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este check-in?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
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
