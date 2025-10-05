<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'contraseña',
    ];
}
