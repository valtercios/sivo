<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEncaminharLigaCorposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpos', function (Blueprint $table) {
            $table->integer('encaminhar_liga')->after('cadastradoPor')->default('0')->nullable();
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
            $table->dropColumn('encaminhar_liga');
        });
    }
}
