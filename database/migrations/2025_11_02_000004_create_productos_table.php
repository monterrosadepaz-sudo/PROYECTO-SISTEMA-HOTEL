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
        Schema::create('producto', function (Blueprint $table) {
            $table->char('idProducto', 36)->primary();
            $table->string('nombre', 100);
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->nullable()->default(0); // ← corregido: permitir null según controllers
            $table->string('tipo', 50); // ejemplo: bebida, comida, servicio
            $table->boolean('estado')->default(1); // 1 = activo, 0 = inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
