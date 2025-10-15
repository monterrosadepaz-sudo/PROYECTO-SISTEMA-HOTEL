<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboard'; // si decides crear una tabla futura

    protected $fillable = [
        'idHabitacion',
        'idCliente',
        'modo', // 'Check-In' o 'Reserva'
        'fechaEvento',
        'estadoHabitacion',
        'tipoHabitacion',
        'nombreCliente',
        'telefonoCliente'
    ];

    public $timestamps = false; // si no usas created_at / updated_at

    // Relaciones opcionales
    public function habitacion()
    {
        return $this->belongsTo(\App\Models\Admin\Habitacion::class, 'idHabitacion');
    }

    public function cliente()
    {
        return $this->belongsTo(\App\Models\Admin\Cliente::class, 'idCliente');
    }
}