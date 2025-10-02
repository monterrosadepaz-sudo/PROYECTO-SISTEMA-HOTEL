<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacion extends Model
{
    protected $fillable = [
        'numero',
        'tipo',
        'descripcion',
        'precio',
        'estado',
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}

