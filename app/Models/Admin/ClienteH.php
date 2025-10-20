<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClienteH extends Model
{
    protected $table = 'cliente_historial';       // Nombre de la tabla clon
    protected $primaryKey = 'idHistorial';         // Clave primaria INT AI
    public $incrementing = true;                   // Autoincremental
    protected $keyType = 'int';                    // Tipo entero

    protected $fillable = [
        'idCliente',   // UUID original del cliente
        'nombre',
        'apellido',
        'documento',
        'telefono',
        'notas',
    ];
}
