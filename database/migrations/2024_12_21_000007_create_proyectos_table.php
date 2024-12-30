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
        $table->string('archivo_final_url')->nullable();
        $table->integer('horas_estimadas')->nullable();
        $table->integer('precio')->nullable();
        $table->integer('calificacion_trabajo')->nullable();
        $table->foreignId('usuario_id')->nullable()->constrained('usuario')->onDelete('cascade');
        $table->foreignId('perfil_desarrollador_id')->nullable()->constrained('perfil_desarrollador')->onDelete('cascade');
        $table->foreignId('urgencia_id')->nullable()->constrained('urgencia')->onDelete('cascade');
        $table->foreignId('confidencialidad_id')->nullable()->constrained('confidencialidad')->onDelete('cascade');
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
