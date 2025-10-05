<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           Schema::create('habitacion', function (Blueprint $table) {
        $table->char('idHabitacion', 36)->primary();
        $table->string('tipoHabitacion', 50);
        $table->integer('capacidad');
        $table->integer('numero')->unique();
        $table->boolean('estado')->default(1); // 1 = disponible físicamente, 0 = fuera de servicio
        $table->string('notas', 255)->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
