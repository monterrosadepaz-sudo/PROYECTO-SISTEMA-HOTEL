<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Reserva;
use App\Models\Admin\Habitacion;

class CheckoutController extends Controller
{
    // Mostrar reservas activas para check-out
    public function index()
    {
        $reservas = Reserva::where('estado', 'activa')
            ->with(['cliente', 'habitacion', 'ventas.producto'])
            ->get();

        return view('recepcionista.checkout', compact('reservas'));
    }

    // Registrar salida del cliente
    public function registrarSalida($idReserva)
    {
        $reserva = Reserva::with('habitacion')->findOrFail($idReserva);

        // Actualizar estado de la reserva
        $reserva->estado = 'finalizada';
        $reserva->save();

        // Liberar habitación
        $habitacion = $reserva->habitacion;
        $habitacion->estado = 'disponible';
        $habitacion->save();

        return redirect()->route('checkout.index')->with('success', 'Salida registrada correctamente');
    }
}
