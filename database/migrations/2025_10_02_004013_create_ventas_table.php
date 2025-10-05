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
        $table->char('idVenta', 36)->primary();
        $table->char('idReserva', 36);
        $table->char('idProducto', 36);
        $table->char('idEmpleado', 36);
        $table->integer('cantidad');
        $table->decimal('monto', 10, 2);
        $table->date('fecha');
        $table->timestamps();

        $table->foreign('idReserva')->references('idReserva')->on('reserva')->onDelete('cascade');
        $table->foreign('idProducto')->references('idProducto')->on('producto')->onDelete('cascade');
        $table->foreign('idEmpleado')->references('idEmpleado')->on('empleado')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
