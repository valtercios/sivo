<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollunmCodCboToEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrevistas', function (Blueprint $table) {
            $table->string('cod_cbo', 6)->nullable()->after('ocupacao_id');

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
            $table->dropColumn('cod_cbo');
        });
    }
}
