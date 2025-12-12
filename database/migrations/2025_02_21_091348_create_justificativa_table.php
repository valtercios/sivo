<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificativa', function (Blueprint $table) {
            $table->id();
            $table->string('tabela')->nullable();
            $table->unsignedBigInteger('registro_id')->nullable();
            $table->unsignedBigInteger('corpo_id')->nullable();
            $table->text('justificativa')->nullable();
            $table->json('alteracoes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justificativa');
    }
}
