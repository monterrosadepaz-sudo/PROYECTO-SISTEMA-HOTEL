<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cliente extends Model
{
    // Nombre de la tabla en la base experimental
    protected $table = 'cliente';

    // Clave primaria UUID
    protected $primaryKey = 'idCliente';
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos asignables en camelCase
    protected $fillable = [
        'idCliente',
        'nombre',
        'apellido',
        'documento',
        'telefono',
    ];

    // Generar UUID automáticamente si no se recibe
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->idCliente)) {
                $model->idCliente = (string) Str::uuid();
            }
        });
    }

    // Relación con reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'idCliente');
    }

    // Relación con check-ins
    public function checkins(): HasMany
    {
        return $this->hasMany(\App\Models\Recepcionista\Checkin::class, 'idCliente');
    }
}

