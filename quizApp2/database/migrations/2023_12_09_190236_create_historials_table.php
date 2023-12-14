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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPregunta');
            $table->foreignId('idRespuesta');
            $table->string('alias',100);
            $table->boolean('esCorrecta');
            $table->timestamps();
            
                        // Definir la clave foránea
            $table->foreign('idPregunta')->references('id')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idRespuesta')->references('id')->on('respuestas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historials');
    }
};
