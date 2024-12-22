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
        $table->string('value')->primary(); 
    });

    DB::table('confidencialidad')->insert([
        ['value' => 'MUYALTO'],
        ['value' => 'ALTO'],
        ['value' => 'MEDIO'],
        ['value' => 'BAJO'],
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
