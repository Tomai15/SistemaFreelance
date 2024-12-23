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
        Schema::create('tecnologia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        DB::table('tecnologia')->insert([
            ['id' => 1 , 'nombre' => 'PHP'],
            ['id' => 2 , 'nombre' => 'Java'],
            ['id' => 3 , 'nombre' => 'Javascript'],
            ['id' => 4 , 'nombre' => 'Kotlin'],
            ['id' => 5 , 'nombre' => 'Laravel'],
            ['id' => 6 , 'nombre' => 'React'],
            ['id' => 7 , 'nombre' => 'Angular'],
            ['id' => 8 , 'nombre' => 'Blade'],
            ['id' => 9 , 'nombre' => 'Bootstrap'],
            ['id' => 10 , 'nombre' => 'Vue'],
        ]);
    }
    //PHP Java Javascript Kotlin Laravel React Angular Blade Bootstrap Vue

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnologias');
    }
};
