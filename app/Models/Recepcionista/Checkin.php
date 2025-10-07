<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cliente;
use App\Models\Habitacion;

class Checkin extends Model
{
    protected $table = 'reserva'; // Usamos la tabla existente
    protected $primaryKey = 'idReserva';
    public $timestamps = true;

    protected $fillable = [
        'idCliente',
        'idHabitacion',
        'fechaEntrada',
        'fechaSalida',
        'estado',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function habitacion(): BelongsTo
    {
        return $this->belongsTo(Habitacion::class, 'idHabitacion');
    }
}
