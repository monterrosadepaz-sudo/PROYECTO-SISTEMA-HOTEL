<?php

use Illuminate\Support\Facades\Route;

// Página de inicio (login o home, tú decides cuál usar)
Route::view('/', 'home'); 
// Si prefieres que sea 'home', solo cambia 'auth.login' por 'home'

// Admin
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard');
    Route::view('/reservas', 'admin.reservas');
    Route::view('/habitaciones', 'admin.habitaciones');
    Route::view('/clientes', 'admin.clientes');
    Route::view('/reportes', 'admin.reportes');
});

// Recepcionista
Route::prefix('recepcionista')->group(function () {
    Route::view('/dashboard', 'recepcionista.dashboard');
    Route::view('/checkin', 'recepcionista.checkin');
    Route::view('/checkout', 'recepcionista.checkout');
    Route::view('/reservas', 'recepcionista.reservas');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/recepcionista', function () {
    return view('recepcionista.dashboard');
});