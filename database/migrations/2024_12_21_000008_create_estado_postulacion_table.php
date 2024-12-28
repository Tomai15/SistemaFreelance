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
        Schema::create('estado_postulacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estado');
        });

        DB::table('estado_postulacion')->insert([
            ['nombre_estado' => 'Pendiente'],
            ['nombre_estado' => 'Aprobado'],
            ['nombre_estado' => 'Rechazado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_postulacion');
    }
};
