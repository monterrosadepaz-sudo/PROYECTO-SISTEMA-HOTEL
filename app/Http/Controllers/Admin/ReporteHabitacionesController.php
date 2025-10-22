<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recepcionista\Dashboard;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteHabitacionesController extends Controller
{
    /**
     * Muestra la vista del reporte de habitaciones en Admin.
     */
    public function index()
    {
        $habitaciones = Dashboard::obtenerEstadoHabitaciones()->map(function ($h) {
            $cliente = null;
            $modo = 'Disponible';
            $estado = $h->estado;

            if ($estado === 'No disponible') {
                if ($h->checkin && in_array(strtolower($h->checkin->estado), ['activo','activa'])) {
                    $cliente = $h->checkin->cliente;
                    $modo = 'Ocupada por check-in';
                } elseif ($h->reserva && strtolower($h->reserva->estado) === 'confirmada') {
                    $cliente = $h->reserva->cliente;
                    $modo = 'Ocupada por reserva';
                } else {
                    $modo = 'Ocupada (sin detalle)';
                }
            }

            return [
                'numero'   => $h->numero,
                'estado'   => $estado,
                'tipo'     => $h->tipoHabitacion ?? 'Sin tipo',
                'cliente'  => $cliente ? $cliente->nombre.' '.$cliente->apellido : '—',
                'telefono' => $cliente ? $cliente->telefono : '—',
                'modo'     => $modo
            ];
        });

        return view('admin.reportesHabitaciones', compact('habitaciones'));
    }

    /**
     * Genera el PDF del reporte de habitaciones.
     */
    public function exportarPdf()
    {
        $habitaciones = Dashboard::obtenerEstadoHabitaciones()->map(function ($h) {
            $cliente = null;
            $modo = 'Disponible';
            $estado = $h->estado;

            if ($estado === 'No disponible') {
                if ($h->checkin && in_array(strtolower($h->checkin->estado), ['activo','activa'])) {
                    $cliente = $h->checkin->cliente;
                    $modo = 'Ocupada por check-in';
                } elseif ($h->reserva && strtolower($h->reserva->estado) === 'confirmada') {
                    $cliente = $h->reserva->cliente;
                    $modo = 'Ocupada por reserva';
                } else {
                    $modo = 'Ocupada (sin detalle)';
                }
            }

            return [
                'numero'   => $h->numero,
                'estado'   => $estado,
                'tipo'     => $h->tipoHabitacion ?? 'Sin tipo',
                'cliente'  => $cliente ? $cliente->nombre.' '.$cliente->apellido : '—',
                'telefono' => $cliente ? $cliente->telefono : '—',
                'modo'     => $modo
            ];
        });

        $pdf = Pdf::loadView('admin.reportesHabitaciones', compact('habitaciones'));
        return $pdf->download('reporte_habitaciones.pdf');
    }
}
