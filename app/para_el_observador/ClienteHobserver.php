<?php

namespace App\para_el_observador;

use App\Models\Admin\Cliente;
use App\Models\Admin\ClienteH;

class ClienteHobserver
{
    /**
     * Se ejecuta automáticamente cuando se crea un nuevo cliente.
     */
    public function created(Cliente $cliente): void
    {
        ClienteH::create([
            'idCliente' => $cliente->idCliente,
            'nombre'    => $cliente->nombre,
            'apellido'  => $cliente->apellido,
            'documento' => $cliente->documento,
            'telefono'  => $cliente->telefono,
            'notas'     => $cliente->notas ?? null,
        ]);
    }
}
