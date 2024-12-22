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
            $table->integer('promedio_calificacion')->nullable();
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
