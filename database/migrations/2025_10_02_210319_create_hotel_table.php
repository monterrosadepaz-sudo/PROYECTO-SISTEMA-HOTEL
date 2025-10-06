<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->char('idHotel', 36)->primary();
            $table->string('nombre', 100);
            $table->string('direccion', 255)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('serviciosAdicionales', 255)->nullable();
            $table->date('horarios')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};