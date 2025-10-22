@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="text-center mb-4">
        <h2 class="fw-bold"> Hotel MEGATEC</h2>
        <h4 class="text-secondary">Reporte de Clientes Históricos</h4>
        <p class="text-muted">Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
        <a href="{{ route('admin.reporte.clientes.pdf') }}" class="btn btn-outline-danger mt-2">
            Descargar PDF
        </a>
    </div>

    @if($clientes->isEmpty())
        <div class="alert alert-info text-center">No hay clientes registrados en el historial.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                        <th>UUID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $index => $cliente)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->apellido }}</td>
                        <td>{{ $cliente->documento }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $cliente->idCliente }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="text-center mt-4 text-muted" style="font-size: 12px;">
        Generado por el sistema hotelero MEGATEC &copy; {{ date('Y') }}
    </div>
</div>
@endsection
