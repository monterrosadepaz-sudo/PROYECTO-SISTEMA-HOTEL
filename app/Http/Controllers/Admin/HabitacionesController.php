<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Habitacion;
use Illuminate\Support\Str;

class HabitacionesController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('admin.habitaciones', compact('habitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numeroHabitacion' => 'required|unique:habitacion,numero',
            'tipoHabitacion' => 'required',
            'precioHabitacion' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'notas' => 'nullable|string|max:255',
        ]);

        Habitacion::create([
            'idHabitacion' => Str::uuid(),
            'numero' => $request->numeroHabitacion,
            'tipoHabitacion' => $request->tipoHabitacion,
            'precio' => $request->precioHabitacion,
            'capacidad' => $request->capacidad,
            'notas' => $request->notas,
            'estado' => 'Disponible',
        ]);

        return redirect()->route('habitaciones.index')->with('mensaje', 'Habitación registrada correctamente.');
    }

  public function edit($idHabitacion)
{
    $habitacion = Habitacion::findOrFail($idHabitacion);
    $habitaciones = Habitacion::all(); // Para mantener la tabla visible
    return view('admin.habitaciones', compact('habitacion', 'habitaciones'));
}


    public function update(Request $request, $idHabitacion)
    {
        $request->validate([
            'numeroHabitacion' => 'required|unique:habitacion,numero,' . $idHabitacion . ',idHabitacion',
            'tipoHabitacion' => 'required',
            'precioHabitacion' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'notas' => 'nullable|string|max:255',
        ]);

        $habitacion = Habitacion::findOrFail($idHabitacion);
        $habitacion->update([
            'numero' => $request->numeroHabitacion,
            'tipoHabitacion' => $request->tipoHabitacion,
            'precio' => $request->precioHabitacion,
            'capacidad' => $request->capacidad,
            'notas' => $request->notas,
        ]);

        return redirect()->route('habitaciones.index')->with('mensaje', 'Habitación actualizada correctamente.');
    }

    public function destroy($idHabitacion)
    {
        $habitacion = Habitacion::findOrFail($idHabitacion);
        $habitacion->estado = 'Inactiva';
        $habitacion->save();

        return redirect()->route('habitaciones.index')->with('mensaje', 'Habitación dada de baja correctamente.');
    }

    public function eliminarDefinitivo($idHabitacion)
{
    $habitacion = Habitacion::findOrFail($idHabitacion);
    $habitacion->delete();

    return redirect()->route('habitaciones.index')->with('mensaje', 'Habitación eliminada permanentemente.');
}

}
