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
      Schema::create('historial', function (Blueprint $table) {
        $table->char('idHistorial', 36)->primary();
        $table->char('idEmpleado', 36);
        $table->string('accion', 100);
        $table->text('detalle')->nullable();
        $table->dateTime('fecha');
        $table->timestamps();

        $table->foreign('idEmpleado')->references('idEmpleado')->on('empleado')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
