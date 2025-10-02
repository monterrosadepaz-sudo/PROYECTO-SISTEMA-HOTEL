<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $fillable = [
        'reserva_id',
        'monto',
        'metodo',
        'fecha_pago',
        'referencia',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Reserva::class);
    }
}
