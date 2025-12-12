<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCorposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpos', function (Blueprint $table) {
            $table->text('justificativa')->nullable();
            $table->integer('estabelecimento_destino')->nullable();
            $table->integer('devolver_corpo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corpos', function (Blueprint $table) {
            $table->dropColumn('justificativa');
            $table->dropColumn('estabelecimento_destino');
            $table->dropColumn('devolver_corpo');
        });
    }
}
