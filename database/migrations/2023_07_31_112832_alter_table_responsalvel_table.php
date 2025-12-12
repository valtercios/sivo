<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableResponsalvelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // adicionar coluna sexo na tabela responsavel
        Schema::table('responsaveis', function (Blueprint $table) {
            $table->string('sexo', 1)->nullable()->after('cpf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remover coluna sexo na tabela responsavel
        Schema::table('responsaveis', function (Blueprint $table) {
            $table->dropColumn('sexo');
        });
    }
}
