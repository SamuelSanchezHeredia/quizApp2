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
        Schema::create('respuestas', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('idPregunta');
            $table->string('respuesta',200);
            $table->boolean('esCorrecta');
            $table->timestamps();
            
                        // Definir la clave foránea
            $table->foreign('idPregunta')->references('id')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            // Un mismo artista no puede tener dos discos con el mismo titulo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
};
