<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkout', function (Blueprint $table) {
            $table->bigIncrements('idCheckout');

            // Identificación de la estadía
            $table->uuid('idReserva')->nullable();
            $table->unsignedBigInteger('idCheckin')->nullable();
            $table->enum('tipo', ['reserva', 'checkin'])->nullable();

            // Cliente (snapshot)
            $table->unsignedBigInteger('idClienteHistorial')->nullable();
            $table->string('nombreCliente')->nullable();
            $table->string('telefonoCliente')->nullable();
            $table->string('documentoCliente')->nullable();

            // Habitación (snapshot)
            $table->unsignedBigInteger('idHabitacion')->nullable();
            $table->string('numeroHabitacion')->nullable();
            $table->string('tipoHabitacion')->nullable();
            $table->decimal('precioPorDia', 10, 2)->nullable();

            // Fechas
            $table->date('fechaEntrada')->nullable();
            $table->date('fechaSalida')->nullable();
            $table->integer('diasEstadia')->nullable();

            // Consumos y totales
            $table->decimal('totalEstadia', 10, 2)->nullable();
            $table->decimal('totalConsumos', 10, 2)->nullable();
            $table->decimal('totalGeneral', 10, 2)->nullable();

            // Detalle de consumos (JSON opcional)
            $table->json('detalleConsumos')->nullable();

            // Metadatos
            $table->unsignedBigInteger('registradoPor')->nullable(); // recepcionista
            $table->timestamps();

            // Índices
            $table->index('idReserva');
            $table->index('idCheckin');
            $table->index('idClienteHistorial');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};
