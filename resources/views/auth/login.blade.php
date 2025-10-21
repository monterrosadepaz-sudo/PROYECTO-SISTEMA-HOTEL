@extends('layouts.app')

@section('titulo', 'Inicio de Sesión')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Acceso al sistema</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                               placeholder="ingrese su usuario" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="contrasenha" class="form-label">Contraseña</label>
                        <input type="password" name="contrasenha" id="contrasenha" class="form-control"
                               placeholder="••••••••" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
