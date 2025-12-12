<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOcupacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ocupacao', function (Blueprint $table) {
            $table->id();
            $table->integer('CO_OCUPACAO');
            $table->string('ds_ocupacao', 120);
            $table->string('co_cbo', 6)->nullable();
            $table->string('TP_ESCOLARIDADE', 1)->nullable();
            $table->string('ST_RESTRICAO_IDADE', 2)->nullable();
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
        Schema::dropIfExists('tb_ocupacao');
    }
}
