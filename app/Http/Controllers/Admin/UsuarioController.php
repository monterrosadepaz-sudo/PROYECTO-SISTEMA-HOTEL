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
        

        Usuario::create(
             ['nombre' => $request->nombreUsuario,
             'correo' => $request->correoUsuario,
             'contrasenha' => bcrypt($request->contrasenha),
             'rol' =>trim ($request->rolUsuario),
             'estado' => $request->estadoUsuario,
             
             ]
             
             
        );
        return redirect()->back()->with('mensaje', 'Usuario creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update(
            ['nombre' => $request->nombreUsuario,
            'correo' => $request->correoUsuario,
            'contrasenha' => bcrypt($request->contrasenha),
            'rol' => $request->rolUsuario,
            'estado' => $request->estadoUsuario,
            
            ]

            
        );
        return redirect()->back()->with('mensaje', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->back()->with('mensaje', 'Usuario eliminado correctamente');
    }

    public function edit($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuarios = Usuario::all(); 
    return view('admin.editar_usuario2', compact('usuario', 'usuarios'));
}

}

