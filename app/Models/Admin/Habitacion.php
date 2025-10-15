<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
        'precio', // ← ya existe en la tabla
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'idHabitacion');
    }

    public function estaDisponible(): bool
    {
        return Str::lower((string) $this->estado) === 'disponible';
    }

    public function actualizarEstadoDesdeReservas(): void
    {
        $tieneReservaActiva = $this->reservas()->where('estado', 'activa')->exists();
        $this->estado = $tieneReservaActiva ? 'Ocupada' : 'Disponible';
        $this->save();
    }
    
    public function actualizarEstado(): void
    {
        $tieneReservaActiva = $this->reservas()->where('estado', 'activa')->exists();
        $this->estado = $tieneReservaActiva ? 'No disponible' : 'Disponible';
        $this->save();
}
}
