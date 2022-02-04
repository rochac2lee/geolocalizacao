<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('temperatura');
            $table->string('eDia');
            $table->string('velocidadeVento');
            $table->string('humidadeAr');
            $table->string('ultimaAtualizacao');
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
        Schema::dropIfExists('consultas');
    }
}
