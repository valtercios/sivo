<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRequiredInRgOnResponsaveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsaveis', function (Blueprint $table) {

            //change rg, cpf, orgao_emissor, column to nullable
            $table->string('rg', 20)->nullable()->change();
            $table->string('cpf', 14)->nullable()->change();
            $table->string('orgao_emissor', 10)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rg_on_responsaveis', function (Blueprint $table) {
            //
        });
    }
}
