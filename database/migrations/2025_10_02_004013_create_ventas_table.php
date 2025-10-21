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
       Schema::create('venta', function (Blueprint $table) {
    $table->bigIncrements('idVenta');

    // Reserva usa UUID (char 36)
    $table->char('idReserva', 36)->nullable();
    $table->foreign('idReserva')
          ->references('idReserva')->on('reserva')
          ->onDelete('cascade');

    // Checkin usa BIGINT
    $table->unsignedBigInteger('idCheckin')->nullable();
    $table->foreign('idCheckin')
          ->references('idCheckin')->on('checkin')
          ->onDelete('cascade');

    // Producto (asumo UUID también)
    $table->char('idProducto', 36);
    $table->foreign('idProducto')
          ->references('idProducto')->on('producto')
          ->onDelete('cascade');

    $table->integer('cantidad')->default(1);
    $table->decimal('monto', 10, 2);
    $table->date('fecha');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
