<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use App\Models\Admin\Habitacion;

class DashboardController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::with([
            'checkin.cliente',
            'reserva.cliente'
        ])->get()->map(function ($h) {
            $cliente = null;
            $modo = 'Disponible';

            // Estado base desde la tabla habitacion
            $estado = $h->estado;

            if ($estado === 'No disponible') {
                // Revisar primero check-in activo/activa
                if ($h->checkin && in_array(strtolower($h->checkin->estado), ['activo', 'activa'])) {
                    $cliente = $h->checkin->cliente;
                    $modo = 'Ocupada por check-in';
                }
                // Si no hay check-in, revisar reserva confirmada
                elseif ($h->reserva && strtolower($h->reserva->estado) === 'confirmada') {
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
                'cliente'  => $cliente ? $cliente->nombre . ' ' . $cliente->apellido : '—',
                'telefono' => $cliente ? $cliente->telefono : '—',
                'modo'     => $modo
            ];
        });

        return view('recepcionista.dashboard', ['ocupadas' => $habitaciones]);

    }
}

