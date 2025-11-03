@extends('layouts.app')
@section('contenido')
@section('titulo', 'Panel Recepcionista')

<h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
<br>
<p id="fecha-hora"></p>

<script>
    function actualizarFechaHora() {
        const ahora = new Date();
        const opciones = { 
            weekday: 'long', year: 'numeric', month: 'long', 
            day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' 
        };
        document.getElementById('fecha-hora').innerText = 
            ahora.toLocaleDateString('es-ES', opciones);
    }
    setInterval(actualizarFechaHora, 1000);
    actualizarFechaHora();
</script>
<br>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Check-In</h5>
            <p>Registrar entrada de huéspedes</p>
            <a href="{{ route('checkin.index') }}" class="btn btn-dark">Ir al Check-In</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Check-Out</h5>
            <p>Registrar salida de huéspedes</p>
            <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-dark">Ir al Check-Out</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow text-center p-3">
            <h5>Reservas</h5>
            <p>Ver y gestionar reservas</p>
            <a href="{{ route('reserva.index') }}" class="btn btn-sm btn-dark">Ir</a>
        </div>
    </div>
</div>

<div class="mt-5">
    <h4>Habitaciones registradas</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Número</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Ocupación</th> {{-- ← NUEVA COLUMNA --}}
                </tr>
            </thead>
            <tbody>
                @forelse($ocupadas as $h)
                    <tr>
                        <form>
                            <td><input type="text" class="form-control" value="{{ $h['numero'] }}" readonly></td>
                            <td><input type="text" class="form-control" value="{{ $h['estado'] }}" readonly></td>
                            <td><input type="text" class="form-control" value="{{ $h['tipo'] }}" readonly></td>
                            <td><input type="text" class="form-control" value="{{ $h['cliente'] }}" readonly></td>
                            <td><input type="text" class="form-control" value="{{ $h['telefono'] }}" readonly></td>
                            <td><input type="text" class="form-control" value="{{ $h['modo'] }}" readonly></td> {{-- ← NUEVO CAMPO --}}
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay habitaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
