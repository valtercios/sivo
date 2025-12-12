<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->unsignedBigInteger('corpo_id')->nullable();
        });

        Schema::table('responsaveis', function (Blueprint $table) {
            $table->unsignedBigInteger('corpo_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('corpo_id');
        });

        Schema::table('responsaveis', function (Blueprint $table) {
            $table->dropColumn('corpo_id');
        });
    }
}
