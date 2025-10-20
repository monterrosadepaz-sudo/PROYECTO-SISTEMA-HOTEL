<?php

namespace App\Models\Recepcionista;

use App\Models\Admin\Habitacion;

class Dashboard
{
    /**
     * Devuelve la colección de habitaciones con sus relaciones
     * y atributos listos para el dashboard.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function obtenerEstadoHabitaciones()
    {
        return Habitacion::with(['checkin.cliente', 'reserva.cliente'])->get();
    }
}

