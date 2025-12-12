<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->default('1');
            $table->unsignedBigInteger('corpo_id');
            $table->unsignedBigInteger('entrevistado_por');
            $table->string('estado_civil', 30);
            $table->string('cor', 15);
            $table->string('pai', 150)->nullable();
            $table->string('mae', 150);
            $table->string('telefone', 25)->nullable();
            $table->string('naturalidade', 100);
            $table->unsignedBigInteger('ocupacao_id')->nullable();
            $table->date('data_nascimento_mae')->nullable();
            $table->unsignedBigInteger('obito_fetal')->default('0');
            $table->unsignedBigInteger('ocupacao_mae_id')->nullable();
            $table->string('escolaridade_mae', 50)->nullable();
            $table->string('tipo_de_parto', 20)->nullable();
            $table->integer('nm')->default('0');
            $table->integer('nv')->default('0');
            $table->integer('tempo_gestacao')->nullable();
            $table->unsignedBigInteger('endereco_mae_id')->nullable();
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
        Schema::dropIfExists('entrevistas');
    }
}
