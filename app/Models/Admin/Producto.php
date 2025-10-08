<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Recepcionista\Venta;


class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idProducto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idProducto',
        'nombre',
        'tipo',
        'precio',
        'stock',
        'estado',
    ];

    protected $casts = [
        'precio' => 'float',
        'stock' => 'integer',
        'estado' => 'boolean',
    ];

    public function ventas(): HasMany
    {
    return $this->hasMany(Venta::class, 'idProducto');
    }
}
