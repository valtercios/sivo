<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocIdentificacaoFieldsEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrevistas', function (Blueprint $table) {
            $table->string('documento_identificacao', 50)->after('escolaridade_corpo')->nullable();
            $table->string('num_documento', 30)->after('documento_identificacao')->nullable();
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
            $table->dropColumn('documento_identificacao');
            $table->dropColumn('num_documento');
        });
    }
}
