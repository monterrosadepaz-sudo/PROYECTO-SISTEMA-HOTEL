<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Usuario;
use Illuminate\Support\Facades\Hash;

class RescateController extends Controller
{

    public function vistaUnica(Request $request)
    {
    $usuariosVacios = Usuario::count() === 0;
    return view('auth.login_rescate', compact('usuariosVacios'));
    }

    public function advertencia()
    {
        if (Usuario::count() > 0) {
            return redirect()->route('login')->withErrors(['nombre' => 'Modo rescate desactivado. Ya existen usuarios.']);
        }

        return view('auth.login_rescate_advertencia');
    }

    public function form()
    {
        if (Usuario::count() > 0) {
            return redirect()->route('login')->withErrors(['nombre' => 'Ya existen usuarios registrados.']);
        }

        return view('auth.login_rescate_form');
    }

    public function store(Request $request)
    {
        if (Usuario::count() > 0) {
            return redirect()->route('login')->withErrors(['nombre' => 'Ya existen usuarios registrados.']);
        }

        $request->validate([
            'nombre' => 'required|string|unique:usuarios,nombre',
            
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasenha' => 'required|string|min:6',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            
            'correo' => $request->correo,
            'contrasenha' => Hash::make($request->contrasenha),
            'rol' => 'administrador',
            'estado' => 'activo',
            
        ]);

        return redirect()->route('login')->with('success', 'Usuario de rescate creado. Puedes iniciar sesión.');
    }
}
