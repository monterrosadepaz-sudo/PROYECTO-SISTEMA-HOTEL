<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacion extends Model
{
    // Nombre de la tabla en la base experimental
    protected $table = 'habitacion';

    // Clave primaria UUID
    protected $primaryKey = 'idHabitacion';
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos asignables en camelCase
    protected $fillable = [
        'idHabitacion',
        'numero',
        'tipoHabitacion',
        'capacidad',
        'estado',
        'notas',
    ];

    // Relación con reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'idHabitacion');
    }

    // Método funcional para validar disponibilidad
    public function estaDisponible(): bool
    {
        return $this->estado === 'disponible';
    }
}

