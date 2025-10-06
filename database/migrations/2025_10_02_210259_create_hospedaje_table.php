<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospedaje', function (Blueprint $table) {
            $table->char('idHospedaje', 36)->primary();
            $table->char('idCliente', 36);
            $table->char('idHabitacion', 36);
            $table->dateTime('fechaEntrada');
            $table->dateTime('fechaSalida');
            $table->decimal('total', 10, 2)->default(0.00);
            $table->tinyInteger('estado')->default(1);

            $table->foreign('idCliente')->references('idCliente')->on('cliente');
            $table->foreign('idHabitacion')->references('idHabitacion')->on('habitacion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospedaje');
    }
};