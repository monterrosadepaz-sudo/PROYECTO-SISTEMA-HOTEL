<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkin extends Model
{
    protected $fillable = [
        'reserva_id',
        'fecha_checkin',
        'recibido_por',
        'observaciones',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Reserva::class);
    }
}
