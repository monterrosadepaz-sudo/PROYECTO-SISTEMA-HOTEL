<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Admin\Reserva;
use App\Models\Recepcionista\Checkin;   

class Habitacion extends Model
{
    protected $table = 'habitacion';
    protected $primaryKey = 'idHabitacion';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idHabitacion',
        'numero',
        'tipoHabitacion',
        'capacidad',
        'estado',
        'notas',
        'precio',
    ];

    // Relaciones
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'idHabitacion');
    }

    public function reserva(): HasOne
    {
        return $this->hasOne(Reserva::class, 'idHabitacion')->where('estado', 'confirmada');
    }

    public function checkin(): HasOne
    {
        return $this->hasOne(Checkin::class, 'idHabitacion')->where('estado', 'activa');
    }

    // Métodos de estado
    public function estaDisponible(): bool
    {
        return !$this->checkin && !$this->reserva;
    }

    public function modoOcupacion(): ?string
    {
        if ($this->checkin) {
            return 'Ocupada por check-in';
        }

        if ($this->reserva) {
            return 'Ocupada por reserva';
        }

        return null;
    }

    public function actualizarEstado(): void
    {
        $this->estado = $this->estaDisponible() ? 'Disponible' : 'No disponible';
        $this->save();
    }
}
