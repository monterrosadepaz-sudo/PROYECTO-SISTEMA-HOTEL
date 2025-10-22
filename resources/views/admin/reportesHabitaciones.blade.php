@extends('layouts.app')

@section('contenido')
<div class="container-fluid">
    <h1 class="mb-4"> Reporte de Habitaciones</h1>

    <div class="d-flex justify-content-between mb-3">
        <div>
            
        </div>
        <div>
            <a href="{{ route('reporte.habitaciones.pdf') }}" class="btn btn-danger">
                Generar PDF
            </a>
        </div>
    </div>

    <table class="table table-bordered table-sm text-center align-middle">
        <thead class="table-light">
            <tr style="background-color:#d9ead3; font-weight:bold;">
                <th>Número</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Ocupación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($habitaciones as $h)
            <tr>
                <td>{{ $h['numero'] }}</td>
                <td>{{ $h['tipo'] }}</td>
                <td>{{ $h['estado'] }}</td>
                <td>{{ $h['cliente'] }}</td>
                <td>{{ $h['telefono'] }}</td>
                <td>{{ $h['modo'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No hay habitaciones registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
