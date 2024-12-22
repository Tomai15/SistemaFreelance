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
    Schema::create('proyecto', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_proyecto');
        $table->text('descripcion')->nullable();
        $table->string('url_documento_requerimientos')->nullable();
        $table->integer('horas_estimadas')->nullable();
        $table->string('nivel_urgencia')->nullable();
        $table->integer('calificacion_trabajo')->nullable();
        $table->foreignId('usuario_id')->constrained('usuario')->onDelete('cascade');
        $table->foreign('nivel_urgencia')->references('value')->on('urgencia')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
