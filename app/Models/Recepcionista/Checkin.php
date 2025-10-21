<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Recepcionista\Checkout;
use App\Models\Admin\Cliente;
use App\Models\Admin\Habitacion;
use App\Models\Admin\Reserva;
class Checkin extends Model
{
    protected $table = 'checkin';
    protected $primaryKey = 'idCheckin';
    public $timestamps = true;

    protected $fillable = [
        'idCliente',
        'idHabitacion',
        'fechaEntrada',
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

    public function checkout(): HasOne
    {
        return $this->hasOne(Checkout::class, 'idCheckin');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'activa');
    }

    public function liberarHabitacion()
    {
        if ($this->habitacion) {
            $this->habitacion->update(['estado' => 'Disponible']);
        }
    }

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'idReserva', 'idReserva');
    }   
}

