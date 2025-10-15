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
        Schema::create('checkin', function (Blueprint $table) {
    $table->id('idCheckin');
    $table->char('idCliente', 36);
    $table->char('idHabitacion', 36);
    $table->date('fechaEntrada');
    $table->string('estado')->default('Activo');
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
        Schema::dropIfExists('checkin');
    }
};
