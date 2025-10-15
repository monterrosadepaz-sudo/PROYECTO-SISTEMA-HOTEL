<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'contrasenha',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'contrasenha',
    ];
}
