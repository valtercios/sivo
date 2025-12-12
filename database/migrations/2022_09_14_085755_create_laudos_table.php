<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laudos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_corpo');
            $table->string('estado_civil');
            $table->string('cor');
            $table->string('pai');
            $table->string('mae');
            $table->string('data_nascimento');
            $table->string('telefone', 30);
            $table->string('idade', 50)->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('ocupacao')->nullable();
            $table->integer('obito_fetal')->nullable();
            $table->integer('idade_mae')->nullable();
            $table->string('ocupacao_mae')->nullable();
            $table->string('escolaridade_mae')->nullable();
            $table->string('tipo_de_parto')->nullable();
            $table->integer('nm')->nullable();
            $table->integer('nv')->nullable();
            $table->integer('tempo_gestacao')->nullable();
            $table->string('endereco_mae')->nullable();
            $table->integer('medico')->nullable();
            $table->text('historico')->nullable();
            $table->text('exame_necroscopico')->nullable();
            $table->text('exame_geral')->nullable();
            $table->text('exame_cabeca')->nullable();
            $table->text('exame_abdome')->nullable();
            $table->text('exame_genitalia')->nullable();
            $table->text('exame_membros')->nullable();
            $table->text('exame_macroscopia')->nullable();
            $table->text('exame_microscopia')->nullable();
            $table->text('exame_conclusoes')->nullable();
            $table->integer('causa_a_id')->nullable();
            $table->integer('causa_b_id')->nullable();
            $table->integer('causa_c_id')->nullable();
            $table->integer('causa_d_id')->nullable();
            $table->integer('causa_outras1_id')->nullable();
            $table->integer('causa_outras2_id')->nullable();
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
        Schema::dropIfExists('laudos');
    }
};

