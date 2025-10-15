<?php

namespace App\Http\Controllers\Recepcionista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcionista\Checkin;
use App\Models\Admin\Habitacion;
use App\Models\Admin\Cliente;

class CheckinController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Entrando al método index() del controlador');

        $habitacionesDisponibles = Habitacion::where('estado', 'Disponible')->get();


        // Checkins activos
        $checkins = Checkin::with(['cliente', 'habitacion'])
            ->where('estado', 'activa')
            ->orderByDesc('created_at')
            ->get();

        // Carga condicional del formulario de edición
        $checkinEdit = null;
        if ($request->has('editar')) {
            $checkinEdit = Checkin::with(['cliente', 'habitacion'])
                ->find($request->editar);

            if ($checkinEdit) {
                Log::info('Cargando formulario de edición para checkin: ' . $checkinEdit->idCheckin);
            }
        }

        return view('recepcionista.checkin', compact(
            'checkins',
            'checkinEdit',
                'habitacionesDisponibles',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCliente' => 'required',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'documento' => 'required|string',
            'telefono' => 'required|string',
            'idHabitacion' => 'required|exists:habitacion,idHabitacion',
            'fechaEntrada' => 'required|date',
        ]);

        Log::info('Datos recibidos en store()', $request->all());

        $cliente = Cliente::where('documento', $request->documento)->first();

        if (!$cliente) {
            $cliente = Cliente::create([
                'idCliente' => $request->idCliente,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'documento' => $request->documento,
                'telefono' => $request->telefono
            ]);
        }

        try {
            DB::transaction(function () use ($request, $cliente) {
                // Crear checkin
                Checkin::create([
                    'idCliente' => $cliente->idCliente,
                    'idHabitacion' => $request->idHabitacion,
                    'fechaEntrada' => $request->fechaEntrada,
                    'estado' => 'activa',
                ]);

                // Marcar habitación como no disponible
                Habitacion::where('idHabitacion', $request->idHabitacion)
                    ->update(['estado' => 'No disponible']);
            });

            return redirect()->back()->with('success', 'Check-In registrado correctamente');
        } catch (\Exception $e) {
            Log::error('Error al crear checkin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar el Check-In: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idCliente' => 'required',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'documento' => 'required|string',
            'telefono' => 'required|string',
            'idHabitacion' => 'required|exists:habitacion,idHabitacion',
            'fechaEntrada' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                // Buscar check-in
                $checkin = Checkin::findOrFail($id);

                // Actualizar cliente
                $cliente = Cliente::findOrFail($request->idCliente);
                $cliente->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'documento' => $request->documento,
                    'telefono' => $request->telefono,
                ]);

                // Si cambió la habitación, liberar la anterior y ocupar la nueva
                if ($checkin->idHabitacion != $request->idHabitacion) {
                    Habitacion::where('idHabitacion', $checkin->idHabitacion)
                        ->update(['estado' => 'Disponible']);
                    Habitacion::where('idHabitacion', $request->idHabitacion)
                        ->update(['estado' => 'No disponible']);
                }

                // Actualizar check-in
                $checkin->update([
                    'idCliente' => $cliente->idCliente,
                    'idHabitacion' => $request->idHabitacion,
                    'fechaEntrada' => $request->fechaEntrada,
                ]);
            });

            return redirect()->route('checkin.index')->with('success', 'Check-In actualizado');
        } catch (\Exception $e) {
            Log::error('Error al actualizar checkin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo actualizar el Check-In: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $checkin = Checkin::findOrFail($id);

                // Liberar habitación
                Habitacion::where('idHabitacion', $checkin->idHabitacion)
                    ->update(['estado' => 'Disponible']);

                $checkin->delete();
            });

            return redirect()->back()->with('success', 'Check-In eliminado');
        } catch (\Exception $e) {
            Log::error('Error al eliminar checkin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo eliminar el Check-In: ' . $e->getMessage());
        }
    }
}
