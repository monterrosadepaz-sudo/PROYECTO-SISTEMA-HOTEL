<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->string('idItem', 50)->primary();
            $table->string('nombreItem', 100);
            $table->string('descripcion', 255)->nullable();
            $table->integer('cantidadPorHabitacion')->nullable();
            $table->integer('cantidadTotal')->nullable();
            $table->string('ubicacionLugarGuardado', 100)->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->string('proveedor', 100)->nullable();
            $table->string('notas', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};