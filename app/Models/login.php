<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class login extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'rol',
        'estado',
        'contrasenha',
    ];

    protected $hidden = [
        'contrasenha',
    ];

    public function getAuthPassword()
    {
        return $this->contrasenha;
    }
}
