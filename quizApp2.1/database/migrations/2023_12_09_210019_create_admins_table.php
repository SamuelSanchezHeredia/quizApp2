<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->foreign('pregunta');
            $table->foreign('respuesta');
            $table->boolean('esCorrecta');
            $table->timestamps();
            
                        // Definir la clave foránea
            $table->foreign('pregunta')->references('pregunta')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('respuesta')->references('respuesta')->on('respuestas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
