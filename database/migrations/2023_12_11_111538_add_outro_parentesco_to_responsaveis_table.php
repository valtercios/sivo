<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutroParentescoToResponsaveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsaveis', function (Blueprint $table) {
            $table->string('outro_parentesco')->nullable()->after('grau_parentesco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsaveis', function (Blueprint $table) {
            $table->dropColumn('outro_parentesco');
        });
    }
}
