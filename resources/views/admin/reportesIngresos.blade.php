@extends('layouts.app')

@section('contenido')
<div class="container-fluid">
    <h1 class="mb-4"> Reporte de Ingresos</h1>

    {{-- Filtros de fechas --}}
    <form method="GET" action="{{ route('admin.reporte.ingresos') }}" class="mb-3 d-flex gap-3">
        <div>
            <label for="desde">Desde:</label>
            <input type="date" id="desde" name="desde" value="{{ $desde }}" class="form-control">
        </div>
        <div>
            <label for="hasta">Hasta:</label>
            <input type="date" id="hasta" name="hasta" value="{{ $hasta }}" class="form-control">
        </div>
        <div class="align-self-end">
            <button type="submit" class="btn btn-success">Filtrar</button>
        </div>
    </form>

        <a href="{{ route('admin.reporte.ingresos.pdf', ['desde' => $desde, 'hasta' => $hasta]) }}" 
        class="btn btn-danger mb-3">
        Generar PDF
        </a>


    {{-- Tabla estilo Excel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-sm text-center align-middle" style="font-size: 0.9rem;">
            <thead class="table-light">
                <tr style="background-color:#d9ead3; font-weight:bold;">
                    <th>Fecha Salida</th>
                    <th>Cliente</th>
                    <th>Habitación</th>
                    <th>Días</th>
                    <th>Total Estadia</th>
                    <th>Total Consumos</th>
                    <th>Total General</th>
                </tr>
            </thead>
            <tbody>
                @forelse($checkouts as $c)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($c->fechaSalida)->format('d/m/Y') }}</td>
                    <td>{{ $c->nombreCliente }}</td>
                    <td>{{ $c->numeroHabitacion }}</td>
                    <td>{{ $c->diasEstadia }}</td>
                    <td style="background-color:#fff2cc;">${{ number_format($c->totalEstadia, 2) }}</td>
                    <td style="background-color:#cfe2f3;">${{ number_format($c->totalConsumos, 2) }}</td>
                    <td style="background-color:#f4cccc; font-weight:bold;">
                        ${{ number_format($c->totalGeneral, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No hay registros en este rango de fechas</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="background-color:#b6d7a8; font-weight:bold;">
                    <td colspan="4">Totales</td>
                    <td>${{ number_format($totalEstadia, 2) }}</td>
                    <td>${{ number_format($totalConsumos, 2) }}</td>
                    <td>${{ number_format($totalGeneral, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
