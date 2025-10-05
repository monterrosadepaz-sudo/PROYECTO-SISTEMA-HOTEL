<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    // Nombre de la tabla en la base experimental
    protected $table = 'reserva';

    // Clave primaria UUID
    protected $primaryKey = 'idReserva';
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos asignables en camelCase
    protected $fillable = [
        'idReserva',
        'idCliente',
        'idHabitacion',
        'fechaEntrada',
        'fechaSalida',
        'estado',
        'notas',
    ];

    // Relación con Cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    // Relación con Habitacion
    public function habitacion(): BelongsTo
    {
        return $this->belongsTo(Habitacion::class, 'idHabitacion');
    }
}
