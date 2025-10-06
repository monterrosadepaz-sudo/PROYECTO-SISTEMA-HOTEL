<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->char('idRol', 36)->primary();
            $table->string('nombre', 100);
            $table->string('permisos', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};