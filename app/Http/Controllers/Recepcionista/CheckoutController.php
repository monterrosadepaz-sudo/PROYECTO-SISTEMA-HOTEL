<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Reserva;
use App\Models\Recepcionista\Checkin;
use App\Models\Admin\Habitacion;
use App\Models\Recepcionista\Checkout;
use App\Models\Admin\Producto;
use App\Models\Recepcionista\Venta;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    // Mostrar estadías por caducar (reservas confirmadas y check-ins activos)
    public function index()
    {
        $reservas = Reserva::where('estado', 'confirmada')
            ->with(['cliente', 'habitacion', 'ventas.producto'])
            ->get();

        $checkins = Checkin::with(['cliente', 'habitacion'])
            ->where('estado', 'activa')
            ->orderByDesc('created_at')
            ->get();

        $productos = Producto::all();

        return view('recepcionista.checkout', compact('reservas', 'checkins', 'productos'));
    }

    // Registrar salida de una reserva confirmada
    public function registrarSalida(Request $request, $idReserva)
    {
        $reserva = Reserva::with(['cliente', 'habitacion', 'ventas.producto'])->findOrFail($idReserva);

        // Calcular duración en días (precio es por día)
        $entrada = Carbon::parse($reserva->fechaEntrada);
        $salida = Carbon::parse($reserva->fechaSalida);
        $dias = max($entrada->diffInDays($salida), 1); // mínimo 1 día
        $precioPorDia = $reserva->habitacion->precio ?? 0;
        $totalEstadia = $precioPorDia * $dias;

        // Calcular consumos ya registrados
        $totalConsumos = $reserva->ventas->sum(fn($venta) => $venta->producto->precio ?? 0);

        // Registrar consumos adicionales seleccionados
        if ($request->has('productos')) {
            foreach ($request->productos as $idProducto) {
                $producto = Producto::find($idProducto);
                if ($producto) {
                    $totalConsumos += $producto->precio;

                    Venta::create([
                        'idReserva'  => $reserva->idReserva,
                        'idProducto' => $producto->idProducto,
                        'cantidad'   => 1,
                        'monto'      => $producto->precio,
                        'fecha'      => now()->toDateString(),
                    ]);
                }
            }
        }

        // Registrar en tabla checkout
        Checkout::create([
            'idReserva'     => $reserva->idReserva,
            'fechaSalida'   => now(),
            'totalEstadia'  => $totalEstadia,
            'totalConsumos' => $totalConsumos,
        ]);

        // Finalizar reserva y liberar habitación
        $reserva->estado = 'Finalizada';
        $reserva->save();

        if ($reserva->habitacion) {
            $reserva->habitacion->estado = 'Disponible';
            $reserva->habitacion->save();
        }

        // Eliminar cliente activo (ya está en cliente_historial)
        if ($reserva->cliente) {
            $reserva->cliente->delete();
        }

        return redirect()->route('checkout.index')
            ->with('success', 'Salida de reserva registrada correctamente.');
    }

    // Registrar salida de un check-in activo
    public function registrarCheckin(Request $request, $idCheckin)
    {
        $checkin = Checkin::with(['cliente', 'habitacion', 'reserva'])->findOrFail($idCheckin);

        // Calcular duración en días desde la fecha de entrada hasta ahora
        $entrada = Carbon::parse($checkin->fechaEntrada);
        $salida = Carbon::now();
        $dias = max($entrada->diffInDays($salida), 1);
        $precioPorDia = $checkin->habitacion->precio ?? 0;
        $totalEstadia = $precioPorDia * $dias;

        // Calcular consumos asociados a la reserva
        $totalConsumos = $checkin->reserva?->ventas->sum(fn($venta) => $venta->producto->precio ?? 0) ?? 0;

        // Registrar consumos adicionales seleccionados
        if ($request->has('productos')) {
            foreach ($request->productos as $idProducto) {
                $producto = Producto::find($idProducto);
                if ($producto) {
                    $totalConsumos += $producto->precio;

                    Venta::create([
                        'idCheckin'  => $checkin->idCheckin,
                        'idProducto' => $producto->idProducto,
                        'cantidad'   => 1,
                        'monto'      => $producto->precio,
                        'fecha'      => now()->toDateString(),
                    ]);
                }
            }
        }

        // Registrar en tabla checkout
        Checkout::create([
            'idCheckin'     => $checkin->idCheckin,
            'fechaSalida'   => now(),
            'totalEstadia'  => $totalEstadia,
            'totalConsumos' => $totalConsumos,
        ]);

        // Finalizar check-in y liberar habitación
        $checkin->estado = 'Finalizado';
        $checkin->save();

        if ($checkin->habitacion) {
            $checkin->habitacion->estado = 'Disponible';
            $checkin->habitacion->save();
        }

        // Eliminar cliente activo (ya está en cliente_historial)
        if ($checkin->cliente) {
            $checkin->cliente->delete();
        }

        return redirect()->route('checkout.index')
            ->with('success', 'Salida de check-in registrada correctamente.');
    }
}
