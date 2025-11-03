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
        Schema::create('reserva', function (Blueprint $table) {
            $table->char('idReserva', 36)->primary();
            $table->char('idCliente', 36);
            $table->char('idHabitacion', 36);
            $table->date('fechaEntrada');
            $table->date('fechaSalida');
            $table->string('estado', 50); // activa, cancelada, finalizada, etc.
            $table->timestamps();

            $table->foreign('idCliente')->references('idCliente')->on('cliente')->onDelete('cascade');
            $table->foreign('idHabitacion')->references('idHabitacion')->on('habitacion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};

