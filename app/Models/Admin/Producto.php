<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

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
}
