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
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('rg', 20);
            $table->string('orgao_emissor', 10);
            $table->string('cpf', 20);
            $table->tinyInteger('parente');
            $table->string('grau_parentesco', 50)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->unsignedBigInteger('endereco_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos');

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
        Schema::dropIfExists('responsaveis');
    }
};
