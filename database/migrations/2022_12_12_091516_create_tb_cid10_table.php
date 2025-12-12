<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCid10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cid10', function (Blueprint $table) {
            $table->id();
            $table->string('CO_AGRUPAMENTO');
            $table->string('CO_CATEGORIA_PAI');
            $table->string('CO_CATEGORIA_SUBCATEGORIA');
            $table->string('CO_CATEG_SUBCATEG_SP');
            $table->string('NO_CATEGORIA_SUBCATEGORIA');
            $table->string('ST_ASTERISCO');
            $table->string('ST_CRUZ');
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
        Schema::dropIfExists('tb_cid10');
    }
}
