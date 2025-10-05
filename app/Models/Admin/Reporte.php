<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    // Nombre de la tabla en la base experimental
    protected $table = 'reporte';

    // Clave primaria UUID
    protected $primaryKey = 'idReporte';
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos asignables en camelCase
    protected $fillable = [
        'idReporte',
        'tipo',
        'fechaInicio',
        'fechaFin',
        'generadoPor',
        'contenido',
    ];
}
