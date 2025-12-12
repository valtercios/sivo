<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoCorpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_corpo', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->string('conteudo');
            $table->string('icon', 40);
            $table->unsignedBigInteger('corpo_id');
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
        Schema::dropIfExists('historico_corpo');
    }
}
