<?php
namespace App\Models\Recepcionista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin\Reserva;
use App\Models\Admin\Producto;

class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'idVenta';
    public $incrementing = true;       
    protected $keyType = 'int';       

    protected $fillable = [
        'idReserva',
        'idProducto',
        'idEmpleado',
        'cantidad',
        'monto',
        'fecha',       
        'metodo',
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
