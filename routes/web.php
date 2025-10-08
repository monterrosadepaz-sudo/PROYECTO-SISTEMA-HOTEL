<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\HabitacionesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Recepcionista\CheckinController;
use App\Http\Controllers\Recepcionista\ReservaController;
use App\Http\Controllers\Recepcionista\CheckoutController;

// Página de inicio que manda al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Vistas del administrador
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard')->middleware('auth');
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

    // Gestión de productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{idProducto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{idProducto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{idProducto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::delete('/productos/{idProducto}/eliminar', [ProductoController::class, 'eliminarDefinitivo'])->name('productos.eliminarDefinitivo');
    Route::put('/productos/{idProducto}/reactivar', [ProductoController::class, 'reactivar'])->name('productos.reactivar');
});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//



// Vistas del recepcionista
    Route::prefix('recepcionista')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('recepcionista.dashboard'))->name('recepcionista.dashboard');

    // CRUD completo para Check-In
    Route::get('/checkin', [CheckinController::class, 'index'])->name('checkin.index');
    Route::post('/checkin', [CheckinController::class, 'store'])->name('checkin.store');
    Route::put('/checkin/{id}', [CheckinController::class, 'update'])->name('checkin.update');
    //Route::delete('/checkin/{id}', [CheckinController::class, 'destroy'])->name('checkin.destroy');
    Route::delete('/checkin/{idCheckin}', [CheckinController::class, 'destroy'])->name('checkin.destroy');


    //  Reservas 
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reserva.index');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reserva.store');
    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reserva.edit');
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reserva.update');
    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])->name('reserva.destroy');
    Route::put('/reservas/{id}/confirmar', [ReservaController::class, 'confirmar'])->name('reserva.confirmar');

    // Check-Out
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/{idReserva}/registrar', [CheckoutController::class, 'registrarSalida'])->name('checkout.registrar');
   


    // Otras vistas
   
    Route::view('/consumos', 'recepcionista.consumos');
    Route::view('/home', 'recepcionista.home');
    Route::view('/welcome', 'recepcionista.welcome');
});

