<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->char('idHabitacion', 36)->primary();
            $table->string('tipoHabitacion', 50)->nullable();
            $table->integer('capacidad')->nullable();
            $table->integer('numero')->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->string('notas', 255)->nullable();
            $table->decimal('precio', 10, 2)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habitacion');
    }
};
