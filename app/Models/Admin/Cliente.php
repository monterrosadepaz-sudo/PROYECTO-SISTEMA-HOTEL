<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'email',
        'direccion',
        'notas',
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}
