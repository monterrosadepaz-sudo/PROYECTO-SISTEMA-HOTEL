<?php

namespace App\Models\Recepcionista;


use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'idCheckout';

    protected $fillable = [
        'idReserva',
        'idCheckin',
        'tipo',
        'idClienteHistorial',
        'nombreCliente',
        'telefonoCliente',
        'documentoCliente',
        'idHabitacion',
        'numeroHabitacion',
        'tipoHabitacion',
        'precioPorDia',
        'fechaEntrada',
        'fechaSalida',
        'diasEstadia',
        'totalEstadia',
        'totalConsumos',
        'totalGeneral',
        'detalleConsumos',
        'registradoPor',
    ];

    protected $casts = [
        'detalleConsumos' => 'array',
        'fechaEntrada'    => 'date',
        'fechaSalida'     => 'date',
    ];
}



