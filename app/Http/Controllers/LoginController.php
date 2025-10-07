<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\login;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'contrasenha' => 'required|string',
        ]);

        $usuario = login::where('nombre', $request->nombre)->first();

        if (!$usuario || !Hash::check($request->contrasenha, $usuario->contrasenha)) {
            return back()->withErrors(['nombre' => 'Credenciales inválidas'])->withInput();
        }

        Auth::login($usuario);

        // Redirección condicional por rol
        switch ($usuario->rol) {
            case 'administrador':
                return redirect()->route('admin.dashboard');
            case 'recepcionista':
                return redirect()->route('recepcionista.dashboard');
            default:
                Auth::logout();
                return back()->withErrors(['nombre' => 'Rol no autorizado']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}


