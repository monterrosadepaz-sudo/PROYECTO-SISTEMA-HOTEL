<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->char('idEmpleado', 36)->primary();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->date('fechaContratacion')->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->tinyInteger('estado')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
