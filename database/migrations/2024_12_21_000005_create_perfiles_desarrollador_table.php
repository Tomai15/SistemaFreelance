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
        Schema::create('perfil_desarrollador', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nombre');
            $table->string('apellido');
            $table->string('CBU');
            $table->string('telefono');
            $table->text('descripcion_sobre_mi')->nullable();
            $table->float('promedio_calificacion')->nullable();
            $table->foreignId('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles_desarrollador');
    }
};
