<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin\Reserva;
use App\Models\Recepcionista\Checkin;

class Checkout extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'idCheckout';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idCheckin',
        'idReserva',
        'fechaSalida',
        'totalEstadia',
        'totalConsumos',
        'estado',
    ];

    protected $casts = [
        'fechaSalida'   => 'date',
        'totalEstadia'  => 'decimal:2',
        'totalConsumos' => 'decimal:2',
        
    ];

    /**
     * Relación con la reserva asociada
     */
    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'idReserva', 'idReserva');
    }

    /**
     * Relación con el checkin asociado (si aplica)
     */
    public function checkin(): BelongsTo
    {
        return $this->belongsTo(Checkin::class, 'idCheckin', 'idCheckin');
    }

    /**
     * Accesor para mostrar resumen financiero
     */
    public function getResumenPagoAttribute(): string
    {
        $totalFinal = ($this->totalEstadia ?? 0) + ($this->totalConsumos ?? 0);

        return '$' . number_format($totalFinal, 2) .
               ' (Estadía: $' . number_format($this->totalEstadia ?? 0, 2) .
               ', Consumos: $' . number_format($this->totalConsumos ?? 0, 2) . ')';
    }
}

