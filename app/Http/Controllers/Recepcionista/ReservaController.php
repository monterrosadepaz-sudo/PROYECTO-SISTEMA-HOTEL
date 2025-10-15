<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin\Reserva;
use App\Models\Admin\Habitacion;
use App\Models\Admin\Cliente;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['cliente', 'habitacion'])->get();
        $habitacionesOcupadasIds = Reserva::where('estado', 'confirmada')->pluck('idHabitacion');
        $habitacionesDisponibles = Habitacion::whereNotIn('idHabitacion', $habitacionesOcupadasIds)
            ->whereRaw('LOWER(estado) = ?', ['disponible'])
            ->get();

        return view('recepcionista.reservas', compact('reservas', 'habitacionesDisponibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCliente' => 'required|uuid',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'documento' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'idHabitacion' => 'required|exists:habitacion,idHabitacion',
            'fechaEntrada' => 'required|date',
            'fechaSalida' => 'nullable|date|after_or_equal:fechaEntrada',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $uuid = $request->idCliente;

        $cliente = Cliente::where('documento', $request->documento)->first();

        if (!$cliente) {
            $cliente = Cliente::create([
                'idCliente' => $request->idCliente,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'documento' => $request->documento,
                'telefono' => $request->telefono,
            ]);
        }

        Reserva::create([
            'idReserva' => $uuid,
            'idCliente' => $uuid,
            'idHabitacion' => $request->idHabitacion,
            'fechaEntrada' => $request->fechaEntrada,
            'fechaSalida' => $request->fechaSalida,
            'estado' => $request->estado,
        ]);

        $habitacion = Habitacion::find($request->idHabitacion);
        if ($habitacion) {
            if ($request->estado === 'confirmada') {
                $habitacion->estado = 'No disponible';
            } else {
                $habitacion->estado = 'Disponible';
            }
            $habitacion->save();
        }

        return redirect()->back()->with('success', 'Reserva registrada correctamente');
    }

    public function edit($id)
    {
        $reservaEdit = Reserva::findOrFail($id);
        $reservas = Reserva::with(['cliente', 'habitacion'])->get();
        $habitacionesOcupadasIds = Reserva::where('estado', 'confirmada')->pluck('idHabitacion');
        $habitacionesDisponibles = Habitacion::whereNotIn('idHabitacion', $habitacionesOcupadasIds)
            ->whereRaw('LOWER(estado) = ?', ['disponible'])
            ->get();

        return view('recepcionista.reservas', compact('reservaEdit', 'reservas', 'habitacionesDisponibles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'documento' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'idHabitacion' => 'required|exists:habitacion,idHabitacion',
            'fechaEntrada' => 'required|date',
            'fechaSalida' => 'nullable|date|after_or_equal:fechaEntrada',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $reserva = Reserva::findOrFail($id);
        $cliente = Cliente::findOrFail($reserva->idCliente);

        $cliente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
        ]);

        $habitacionAnterior = Habitacion::find($reserva->idHabitacion);
        $habitacionNueva = Habitacion::find($request->idHabitacion);

        $reserva->update([
            'idCliente' => $request->idCliente,
            'idHabitacion' => $request->idHabitacion,
            'fechaEntrada' => $request->fechaEntrada,
            'fechaSalida' => $request->fechaSalida,
            'estado' => $request->estado,
        ]);

        if ($habitacionAnterior && $habitacionAnterior->idHabitacion !== $request->idHabitacion) {
            $habitacionAnterior->estado = 'Disponible';
            $habitacionAnterior->save();
        }

        if ($habitacionNueva) {
            if ($request->estado === 'confirmada') {
                $habitacionNueva->estado = 'No disponible';
            } else {
                $habitacionNueva->estado = 'Disponible';
            }
            $habitacionNueva->save();
        }

        return redirect()->route('reserva.index')->with('success', 'Reserva actualizada correctamente');
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $habitacion = Habitacion::find($reserva->idHabitacion);

        if ($habitacion && $reserva->estado === 'confirmada') {
            $habitacion->estado = 'Disponible';
            $habitacion->save();
        }

        $reserva->delete();

        return redirect()->back()->with('success', 'Reserva eliminada correctamente');
    }

    public function confirmar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update(['estado' => 'confirmada']);

        $habitacion = Habitacion::find($reserva->idHabitacion);
        if ($habitacion) {
            $habitacion->estado = 'No disponible';
            $habitacion->save();
        }

        return redirect()->back()->with('success', 'Reserva confirmada');
    }
}