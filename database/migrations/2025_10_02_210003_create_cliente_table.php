<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La tabla ya existe, así que no la crees de nuevo.
        // Puedes dejar vacío el método up o usar Schema::table para modificarla si es necesario.
    }

    public function down(): void
    {
        // Si quieres que la migración pueda revertirse, puedes eliminar la tabla:
        // Schema::dropIfExists('cliente');
    }
};
