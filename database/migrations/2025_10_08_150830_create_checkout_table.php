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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id('idCheckout'); // PK autoincremental

            // Relación con checkin (opcional)
            $table->unsignedBigInteger('idCheckin')->nullable();

            // Relación con reserva (opcional)
            $table->char('idReserva', 36)->nullable();

            $table->date('fechaSalida');
            $table->decimal('totalEstadia', 10, 2)->default(0);
            $table->decimal('totalConsumos', 10, 2)->default(0);
            $table->string('estado')->default('Finalizado');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idCheckin')
                  ->references('idCheckin')
                  ->on('checkin')
                  ->onDelete('cascade');

            $table->foreign('idReserva')
                  ->references('idReserva')
                  ->on('reserva')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};
