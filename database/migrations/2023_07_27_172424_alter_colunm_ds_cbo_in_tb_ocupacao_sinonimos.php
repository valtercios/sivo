<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColunmDsCboInTbOcupacaoSinonimos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_ocupacao_sinonimos', function (Blueprint $table) {
            $table->string('ds_ocupacao', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_ocupacao_sinonimos', function (Blueprint $table) {
            //
        });
    }
}
