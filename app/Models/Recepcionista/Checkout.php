<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    protected $fillable = [
        'reserva_id',
        'fecha_checkout',
        'entregado_por',
        'observaciones',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Reserva::class);
    }
}
