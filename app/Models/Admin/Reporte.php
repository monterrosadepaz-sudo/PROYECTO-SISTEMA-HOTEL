<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $fillable = [
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'generado_por',
        'contenido',
    ];
}
