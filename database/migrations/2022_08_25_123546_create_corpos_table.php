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
        Schema::create('corpos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('laudo')->nullable();
            $table->integer('num_vo')->nullable();
            $table->string('sexo');
            $table->string('rg')->nullable();
            $table->string('orgao_emissor')->nullable();
            $table->string('cpf')->nullable();
            $table->unsignedBigInteger('endereco_corpo_id');
            $table->foreign('endereco_corpo_id')->references('id')->on('enderecos');
            $table->date('data_nascimento')->nullable();
            $table->datetime('data_entrada');
            $table->datetime('data_obito');
            $table->string('local_obito');
            $table->unsignedBigInteger('endereco_obito_id');
            $table->foreign('endereco_obito_id')->references('id')->on('enderecos');
            $table->unsignedBigInteger('funeraria_id')->nullable();
            $table->foreign('funeraria_id')->references('id')->on('funerarias');
            $table->unsignedBigInteger('responsavel_entrega_id');
            $table->foreign('responsavel_entrega_id')->references('id')->on('responsaveis');
            $table->unsignedBigInteger('responsavel_corpo_id')->nullable();
            $table->foreign('responsavel_corpo_id')->references('id')->on('responsaveis');
            $table->unsignedBigInteger('necrotomista_id')->nullable();
            $table->foreign('necrotomista_id')->references('id')->on('users');
            $table->string('corpoSera')->nullable();
            $table->string('pendencias', 10)->nullable();
            $table->text('observacoes')->nullable();
            $table->string('pertences', 200)->nullable();
            $table->string('cadastradoPor', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corpos');
    }
};
