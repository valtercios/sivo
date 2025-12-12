<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrevistas', function (Blueprint $table) {
            $table->string('morte_relacao_parto', 10)->after('tipo_de_parto')->nullable();
            $table->integer('aposentado')->after('ocupacao_id')->nullable();
            $table->string('escolaridade_corpo', 50)->after('naturalidade')->nullable();
            $table->integer('aposentado_mae')->after('ocupacao_mae_id')->nullable();
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
            $table->dropColumn('morte_relacao_parto');
            $table->dropColumn('aposentado');
            $table->dropColumn('aposentado_mae');
            $table->dropColumn('escolaridade_corpo');
        });
    }
}
