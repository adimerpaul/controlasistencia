<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->string('objetos');
            $table->string('observaciones')->default('');
            $table->string('estado')->default('INGRESADO');
            $table->string('recinto');
            $table->string('motivo');
            $table->string('observado')->default('NO');
            $table->dateTime('salida')->nullable()->default(null);
            $table->string('targeta')->nullable()->default(null);
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->unsignedBigInteger('destino_id');
            $table->foreign('destino_id')->references('id')->on('destinos');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
