<?php

namespace App\Models\Admin;
use App\Models\Admin\Cliente;
use App\Models\Admin\Habitacion;
use App\Models\Recepcionista\Venta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function ventas(): HasMany
    {
    return $this->hasMany(Venta::class, 'idReserva');
    }
}
