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
    Schema::create('confidencialidad', function (Blueprint $table) {
        $table->id();
        $table->string('nivel_confidencialidad'); 
    });

    DB::table('confidencialidad')->insert([
        ['id' => 1, 'nivel_confidencialidad' => 'Baja'],
        ['id' => 2, 'nivel_confidencialidad' => 'Media'],
        ['id' => 3, 'nivel_confidencialidad' => 'Alta'],
        ['id' => 4, 'nivel_confidencialidad' => 'Muy Alta'],
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confidencialidades');
    }
};
