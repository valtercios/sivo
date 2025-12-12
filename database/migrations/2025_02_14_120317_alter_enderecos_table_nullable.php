<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnderecosTableNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tornar os campos cep, logradouro, bairro, cidade e estado da tabela enderecos nulos
        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('cep')->nullable()->change();
            $table->string('logradouro', 100)->nullable()->change();
            $table->string('bairro', 100)->nullable()->change();
            // $table->string('cidade', 100)->nullable()->change();
            $table->string('estado', 2)->nullable()->change();
            // $table->integer('numero')->nullable()->change();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //reverte os campos cep, logradouro, bairro, cidade e estado da tabela enderecos nulos
        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('cep')->nullable(false)->change();
            $table->string('logradouro', 100)->nullable(false)->change();
            $table->string('bairro', 100)->nullable(false)->change();
            $table->string('cidade', 100)->nullable(false)->change();
            $table->string('estado', 2)->nullable(false)->change();
            $table->integer('numero')->nullable(false)->change();
        });        
    }
}
