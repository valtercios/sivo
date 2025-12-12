<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->default('1');
            $table->string('tipo_exame', 40);
            $table->text('observacao')->nullable();
            $table->unsignedBigInteger('corpo_id');
            $table->unsignedBigInteger('solicitado_por');
            $table->text('resposta')->nullable();
            $table->unsignedBigInteger('respondido_por')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exames');
    }
}
