<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFunerariaRetiradaCorposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpos', function (Blueprint $table) {
            $table->unsignedBigInteger('funeraria_retirada_id')->after('funeraria_id')->nullable();
            $table->foreign('funeraria_retirada_id')->references('id')->on('funerarias');
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
            $table->dropColumn('funeraria_retirada_id');
        });
    }
}
