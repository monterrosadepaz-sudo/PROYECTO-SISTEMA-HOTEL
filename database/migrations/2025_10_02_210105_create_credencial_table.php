<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La tabla ya existe, así que no la crees de nuevo.
        // Si necesitas modificar la tabla, usa Schema::table('credencial', function (Blueprint $table) { ... });
    }

    public function down(): void
    {
        // Si quieres que la migración pueda revertirse, puedes eliminar la tabla:
        // Schema::dropIfExists('credencial');
    }
};