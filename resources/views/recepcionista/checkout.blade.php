@extends('layouts.app')

@section('titulo', 'Check-Out')

@section('contenido')
<h3 class="mb-4"> Registrar Check-Out</h3>



@foreach($reservas as $reserva)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $reserva->cliente->nombre ?? 'Sin nombre' }} {{ $reserva->cliente->apellido ?? '' }}</h5>
            <p>Habitación: {{ $reserva->habitacion->numero ?? 'Sin número' }}</p>
            <p>Entrada: {{ $reserva->fechaEntrada }}</p>
            <p>Salida: {{ $reserva->fechaSalida }}</p>
            <p>Total consumos: ${{ $reserva->ventas->sum(fn($v) => $v->producto->precio) }}</p>

            <form method="POST" action="{{ route('checkout.registrar', $reserva->idReserva) }}">
                @csrf
                <button type="submit" class="btn btn-success">Registrar salida</button>
            </form>
        </div>
    </div>



    <form method="POST" action="{{ route('checkout.registrar', $reserva->idReserva) }}" class="card shadow p-4 mb-4">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label">Cliente</label>
                <input type="text" class="form-control" value="{{ $cliente->nombre }} {{ $cliente->apellido }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Habitación</label>
                <input type="text" class="form-control" value="{{ $habitacion->numero }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Fecha Salida</label>
                <input type="date" class="form-control" value="{{ $reserva->fechaSalida }}" readonly>
            </div>
            <div class="col-md-2 text-center">
                <span class="badge bg-warning mt-4">⏳ {{ $restante }}</span>
            </div>
        </div>

        <hr>

        <h5> Consumos registrados</h5>
        @if($ventas->isEmpty())
            <p class="text-muted">No hay productos o servicios registrados.</p>
        @else
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->producto->nombre }}</td>
                            <td>${{ number_format($venta->producto->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h5 class="mt-3">Total a pagar</h5>
        <ul>
            <li>Estadía: ${{ number_format($totalEstadia, 2) }}</li>
            <li>Consumos: ${{ number_format($totalConsumos, 2) }}</li>
            <li><strong>Total: ${{ number_format($total, 2) }}</strong></li>
        </ul>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-success">Registrar salida</button>
        </div>
    </form>
@endforeach
@endsection
