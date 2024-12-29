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
        Schema::create('tipo_estado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo_estado');
        });

        DB::table('tipo_estado')->insert([
            ['id' => 1, 'nombre_tipo_estado' => 'Abierto'],
            ['id' => 2, 'nombre_tipo_estado' => 'En Curso'],
            ['id' => 3, 'nombre_tipo_estado' => 'Cerrado'],
            ['id' => 4, 'nombre_tipo_estado' => 'Entregado'],
            ['id' => 5, 'nombre_tipo_estado' => 'Cancelado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
