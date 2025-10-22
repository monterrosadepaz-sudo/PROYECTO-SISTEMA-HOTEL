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

        $checkins = Checkin::with(['cliente', 'habitacion', 'reserva.ventas.producto'])
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
        $dias = max($entrada->diffInDays($salida), 1);
        $precioPorDia = $reserva->habitacion->precio ?? 0;
        $totalEstadia = $precioPorDia * $dias;

        // Calcular consumos ya registrados
        $totalConsumos = $reserva->ventas->sum(fn($venta) => $venta->monto ?? 0);

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

        // Preparar detalle de consumos
        $detalleConsumos = $reserva->ventas->map(function ($venta) {
            return [
                'producto' => $venta->producto->nombre,
                'cantidad' => $venta->cantidad,
                'monto'    => $venta->monto,
            ];
        });

        // Registrar en tabla checkout (snapshot integral)
        Checkout::create([
            'idReserva'        => $reserva->idReserva,
            'tipo'             => 'reserva',
            'idClienteHistorial' => $reserva->cliente->idClienteHistorial ?? null,
            'nombreCliente'    => $reserva->cliente->nombre ?? null,
            'telefonoCliente'  => $reserva->cliente->telefono ?? null,
            'documentoCliente' => $reserva->cliente->documento ?? null,
            // 'idHabitacion'   => $reserva->habitacion->idHabitacion ?? null, // ❌ ignorado
            'numeroHabitacion' => $reserva->habitacion->numero ?? null,
            'tipoHabitacion'   => $reserva->habitacion->tipo ?? null,
            'precioPorDia'     => $precioPorDia,
            'fechaEntrada'     => $entrada,
            'fechaSalida'      => now(),
            'diasEstadia'      => $dias,
            'totalEstadia'     => $totalEstadia,
            'totalConsumos'    => $totalConsumos,
            'totalGeneral'     => $totalEstadia + $totalConsumos,
            'detalleConsumos'  => $detalleConsumos,
            'registradoPor'    => auth()->id(),
        ]);

        // Finalizar reserva y liberar habitación
        $reserva->estado = 'Finalizada';
        $reserva->save();

        if ($reserva->habitacion) {
            $reserva->habitacion->estado = 'Disponible';
            $reserva->habitacion->save();
        }

        // Ya no borramos cliente, solo lo dejamos inactivo
        if ($reserva->cliente) {
            $reserva->cliente->update(['estado' => 'inactivo']);
        }

        return redirect()->route('checkout.index')
            ->with('success', 'Salida de reserva registrada correctamente.');
    }

    // Registrar salida de un check-in activo
    public function registrarCheckin(Request $request, $idCheckin)
    {
        $checkin = Checkin::with(['cliente', 'habitacion', 'reserva.ventas.producto'])->findOrFail($idCheckin);

        // Calcular duración en días desde la fecha de entrada hasta ahora
        $entrada = Carbon::parse($checkin->fechaEntrada);
        $salida = Carbon::now();
        $dias = max($entrada->diffInDays($salida), 1);
        $precioPorDia = $checkin->habitacion->precio ?? 0;
        $totalEstadia = $precioPorDia * $dias;

        // Calcular consumos asociados a la reserva
        $totalConsumos = $checkin->reserva?->ventas->sum(fn($venta) => $venta->monto ?? 0) ?? 0;

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

        // Preparar detalle de consumos
        $detalleConsumos = $checkin->reserva?->ventas->map(function ($venta) {
            return [
                'producto' => $venta->producto->nombre,
                'cantidad' => $venta->cantidad,
                'monto'    => $venta->monto,
            ];
        });

        // Registrar en tabla checkout (snapshot integral)
        Checkout::create([
            'idCheckin'       => $checkin->idCheckin,
            'tipo'            => 'checkin',
            'idClienteHistorial' => $checkin->cliente->idClienteHistorial ?? null,
            'nombreCliente'   => $checkin->cliente->nombre ?? null,
            'telefonoCliente' => $checkin->cliente->telefono ?? null,
            'documentoCliente'=> $checkin->cliente->documento ?? null,
            // 'idHabitacion'  => $checkin->habitacion->idHabitacion ?? null, // ❌ ignorado
            'numeroHabitacion'=> $checkin->habitacion->numero ?? null,
            'tipoHabitacion'  => $checkin->habitacion->tipo ?? null,
            'precioPorDia'    => $precioPorDia,
            'fechaEntrada'    => $entrada,
            'fechaSalida'     => $salida,
            'diasEstadia'     => $dias,
            'totalEstadia'    => $totalEstadia,
            'totalConsumos'   => $totalConsumos,
            'totalGeneral'    => $totalEstadia + $totalConsumos,
            'detalleConsumos' => $detalleConsumos,
            'registradoPor'   => auth()->id(),
        ]);

        // Finalizar check-in y liberar habitación
        $checkin->estado = 'Finalizado';
        $checkin->save();

        if ($checkin->habitacion) {
            $checkin->habitacion->estado = 'Disponible';
            $checkin->habitacion->save();
        }

        // Ya no borramos cliente, solo lo dejamos inactivo
        if ($checkin->cliente) {
            $checkin->cliente->update(['estado' => 'inactivo']);
        }

        return redirect()->route('checkout.index')
            ->with('success', 'Salida de check-in registrada correctamente.');
    }
}
