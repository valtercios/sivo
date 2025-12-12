<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class CreateTbOcupacaoSinonimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ocupacao_sinonimos', function (Blueprint $table) {
            $table->id();
            $table->string('ds_ocupacao', 120)->nullable();
            $table->string('co_cbo', 7)->nullable();
            $table->string('TIPO')->nullable();
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
        Schema::dropIfExists('tb_ocupacao_sinonimos');
    }
}
