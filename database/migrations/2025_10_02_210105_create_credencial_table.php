<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credencial', function (Blueprint $table) {
            $table->char('idCredenciales', 36)->primary();
            $table->string('usuario', 100);
            $table->string('contrasena', 100);
            $table->date('fechaCreacion')->nullable();
            $table->date('fechaModificacion')->nullable();
            $table->tinyInteger('estado')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credencial');
    }
};