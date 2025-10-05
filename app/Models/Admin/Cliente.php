<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'documento',
        'telefono',
        'email',
        'direccion',
        'notas',
    ];

    // Relación con reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'idCliente');
    }
}
