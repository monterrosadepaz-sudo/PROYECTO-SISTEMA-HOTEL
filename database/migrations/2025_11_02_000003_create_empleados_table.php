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
        Schema::create('empleado', function (Blueprint $table) {
            $table->char('idEmpleado', 36)->primary();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('direccion', 255);
            $table->string('telefono', 20);
            $table->boolean('estado')->default(1); // 1 = activo, 0 = inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
