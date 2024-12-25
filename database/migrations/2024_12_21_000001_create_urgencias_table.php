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
        Schema::create('urgencia', function (Blueprint $table) {
            $table->id();
            $table->string('nivel_urgencia'); 
        });
    
        DB::table('urgencia')->insert([
            ['id' => 1, 'nivel_urgencia' => 'Baja'],
            ['id' => 2, 'nivel_urgencia' => 'Media'],
            ['id' => 3, 'nivel_urgencia' => 'Alta'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urgencias');
    }
};
