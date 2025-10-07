<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recepcionista\Checkin;
use App\Models\Admin\Habitacion;
use App\Models\Admin\Cliente;
use App\Models\Admin\Reserva;

class CheckinController extends Controller
{
    public function index()
    {
        $habitacionesTotales = Habitacion::all();
        $habitacionesOcupadasIds = Reserva::where('estado', 'activa')->pluck('idHabitacion');
        $habitacionesOcupadas = Habitacion::whereIn('idHabitacion', $habitacionesOcupadasIds)->get();
        $habitacionesDisponibles = Habitacion::whereNotIn('idHabitacion', $habitacionesOcupadasIds)
            ->whereRaw('LOWER(estado) = ?', ['disponible'])
            ->get();

        $total = $habitacionesTotales->count();
        $ocupadas = $habitacionesOcupadas->count();
        $disponibles = $habitacionesDisponibles->count();

        $checkins = Checkin::with(['cliente', 'habitacion'])->get();

        return view('recepcionista.checkin', compact(
            'total',
            'ocupadas',
            'disponibles',
            'habitacionesDisponibles',
            'habitacionesOcupadas',
            'checkins'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCliente' => 'required|uuid',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'documento' => 'required|string',
            'telefono' => 'required|string',
            'habitacion_id' => 'required|exists:habitacion,idHabitacion',
            'fecha_entrada' => 'required|date',
        ]);

        // Buscar cliente por documento
        $cliente = Cliente::where('documento', $request->documento)->first();

        // Si no existe, lo creamos manualmente con todos los campos requeridos
        if (!$cliente) {
            $cliente = Cliente::create([
                'idCliente' => $request->idCliente,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'documento' => $request->documento,
                'telefono' => $request->telefono
            ]);
        }

        // Crear el check-in
        $checkin = Checkin::create([
            'idCliente' => $cliente->idCliente,
            'idHabitacion' => $request->habitacion_id,
            'fechaEntrada' => $request->fecha_entrada,
            'estado' => 'activa',
        ]);

        // Marcar habitación como no disponible
        Habitacion::where('idHabitacion', $request->habitacion_id)
            ->update(['estado' => 'No disponible']);

        return redirect()->back()->with('success', 'Check-In registrado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idCliente' => 'required|uuid',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'documento' => 'required|string',
            'telefono' => 'required|string',
            'habitacion_id' => 'required|exists:habitacion,idHabitacion',
            'fecha_entrada' => 'required|date',
        ]);

        $checkin = Checkin::findOrFail($id);

        $cliente = Cliente::where('documento', $request->documento)->first();

        if (!$cliente) {
            $cliente = Cliente::create([
                'idCliente' => $request->idCliente,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
                'documento' => $request->documento
            ]);
        }

        $checkin->update([
            'idCliente' => $cliente->idCliente,
            'idHabitacion' => $request->habitacion_id,
            'fechaEntrada' => $request->fecha_entrada,
        ]);

        return redirect()->back()->with('success', 'Check-In actualizado');
    }

    public function destroy($id)
    {
        $checkin = Checkin::findOrFail($id);
        $checkin->delete();

        Habitacion::where('idHabitacion', $checkin->idHabitacion)
            ->update(['estado' => 'Disponible']);

        return redirect()->back()->with('success', 'Check-In eliminado');
    }
}
