<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historial extends Model
{
    protected $fillable = [
        'idEmpleado',
        'accion',
        'detalle',
        'fecha',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Cliente::class);
    }
}

