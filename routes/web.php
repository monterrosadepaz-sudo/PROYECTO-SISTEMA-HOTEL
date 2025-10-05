<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuarioController;

// Página de inicio
Route::view('/', 'home'); // O 'home' si prefieres

// Vistas del administrador
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard');
    Route::view('/clientes', 'admin.clientes');
    Route::view('/usuarios', 'admin.usuarios');
    Route::view('/reservas', 'admin.reservas');
    Route::view('/habitaciones', 'admin.habitaciones');
    Route::view('/inventario', 'admin.inventario');
    Route::view('/reportes', 'admin.reportes');
    Route::view('/editar_usuario', 'admin.editar_usuario');
    Route::view('/editar_producto', 'admin.editar_producto');


    //rutas para el pishi  CRUD de usuarios 
 
    Route::prefix('admin')->group(function () {
    // Vista principal de gestión de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    // Crear nuevo usuario
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

    // Actualizar usuario existente
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

    // Eliminar usuario
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

});

// Vistas del recepcionista
Route::prefix('recepcionista')->group(function () {
    Route::view('/dashboard', 'recepcionista.dashboard');
    Route::view('/checkin', 'recepcionista.checkin');
    Route::view('/checkout', 'recepcionista.checkout');
    Route::view('/consumos', 'recepcionista.consumos');
    Route::view('/reservas', 'recepcionista.reservas');
    Route::view('/home', 'recepcionista.home');
    Route::view('/welcome', 'recepcionista.welcome');
});


Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/recepcionista', function () {
    return view('recepcionista.dashboard');
});