<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use App\Models\Admin\Habitacion;
use App\Models\Admin\Cliente;

class DashBoardController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all(); // ← corregido: clase con mayúscula
        $clientes = Cliente::all();        // ← corregido: clase con mayúscula

        $ocupadas = [];

        foreach ($habitaciones as $h) {
            // Buscar cliente asociado si la habitación está ocupada
            $cliente = null;
            if ($h->estado === 'No disponible') {
                // Puedes ajustar esta lógica si tienes una relación directa
                $cliente = $clientes->firstWhere('habitacion_id', $h->id);
            }

            $ocupadas[] = [
                'numero' => $h->numero,
                'estado' => $h->estado,
                'tipo' => $h->tipoHabitacion ?? 'Sin tipo',
                'cliente' => $cliente ? $cliente->nombre . ' ' . $cliente->apellido : '—',
                'telefono' => $cliente ? $cliente->telefono : '—',
                'modo' => $h->estado === 'No disponible' ? 'No disponible' : 'Disponible'
            ];
        }

        return view('recepcionista.dashboard', compact('ocupadas'));
    }
}