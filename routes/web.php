<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\HabitacionesController;
use App\Http\Controllers\Recepcion\RecepcionHabitacionController;
use App\Http\Controllers\Admin\ProductoController;

// Página de inicio
Route::view('/', 'home');

// Vistas del administrador
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard');
    Route::view('/clientes', 'admin.clientes');
    Route::view('/usuarios', 'admin.usuarios');
    Route::view('/reservas', 'admin.reservas');
    Route::view('/habitaciones', 'admin.habitaciones');
    Route::view('/inventario', 'admin.inventario');
    Route::view('/reportes', 'admin.reportes');
    Route::view('/editar_producto', 'admin.editar_producto');

    // Gestión de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Gestión de habitaciones
    Route::get('/habitaciones', [HabitacionesController::class, 'index'])->name('habitaciones.index');
    Route::post('/habitaciones', [HabitacionesController::class, 'store'])->name('habitaciones.store');
    Route::get('/habitaciones/{idHabitacion}/edit', [HabitacionesController::class, 'edit'])->name('habitaciones.edit');
    Route::put('/habitaciones/{idHabitacion}', [HabitacionesController::class, 'update'])->name('habitaciones.update');
    Route::delete('/habitaciones/{idHabitacion}', [HabitacionesController::class, 'destroy'])->name('habitaciones.destroy');
    Route::delete('/habitaciones/{idHabitacion}/eliminar-definitivo', [HabitacionesController::class, 'eliminarDefinitivo'])->name('habitaciones.eliminarDefinitivo');

    //rutas del los productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{idProducto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{idProducto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{idProducto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::delete('/productos/{idProducto}/eliminar', [ProductoController::class, 'eliminarDefinitivo'])->name('productos.eliminarDefinitivo');
    Route::put('/productos/{idProducto}/reactivar', [ProductoController::class, 'reactivar'])->name('productos.reactivar');

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

// Accesos directos
Route::get('/admin', fn() => view('admin.dashboard'));
Route::get('/recepcionista', fn() => view('recepcionista.dashboard'));
