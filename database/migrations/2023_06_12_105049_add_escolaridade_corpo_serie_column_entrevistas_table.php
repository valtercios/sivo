<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEscolaridadeCorpoSerieColumnEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrevistas', function (Blueprint $table) {
            $table->string('escolaridade_corpo_serie', 10)->after('escolaridade_corpo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrevistas', function (Blueprint $table) {
            $table->dropColumn('escolaridade_corpo_serie');
        });
    }
}
