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
        Schema::create('tecnologia_por_desarrollador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tecnologia_id')->constrained('tecnologia')->onDelete('cascade'); 
            $table->foreignId('perfil_desarrollador_id')->constrained('perfil_desarrollador')->onDelete('cascade');
            $table->integer('nivel_tecnologia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnologia_por_desarrollador');
    }
};
