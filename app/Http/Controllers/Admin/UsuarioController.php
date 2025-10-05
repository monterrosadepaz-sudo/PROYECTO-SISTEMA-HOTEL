<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.editar_usuario', compact('usuarios'));
    }

    public function store(Request $request)
    {
        Usuario::create($request->all());
        return redirect()->back()->with('mensaje', 'Usuario creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return redirect()->back()->with('mensaje', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->back()->with('mensaje', 'Usuario eliminado correctamente');
    }
}

