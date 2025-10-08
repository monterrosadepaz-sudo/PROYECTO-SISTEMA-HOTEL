<?php

namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin\Reserva;
use App\Models\Admin\Producto;

class Venta extends Model
{
    protected $table = 'venta'; // Asegura que apunte a la tabla correcta
    protected $primaryKey = 'idVenta'; // Ajusta si aplica
    public $incrementing = false; // Si estás usando UUIDs
    protected $keyType = 'string';

    protected $fillable = [
        'idReserva',
        'idProducto',
        'monto',
        'metodo',
        'fecha_pago',
        'referencia',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}

