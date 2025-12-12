<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRequiredInRgOnCorposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpos', function (Blueprint $table) {
            // change to null rg, orgao_emissor, cpf column
            // $table->string('rg', 20)->nullable()->change();
            $table->string('orgao_emissor', 10)->nullable()->change();
            $table->string('cpf', 14)->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rg_on_corpos', function (Blueprint $table) {
            //
        });
    }
}
