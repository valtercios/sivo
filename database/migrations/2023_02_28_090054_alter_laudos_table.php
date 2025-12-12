<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLaudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laudos', function (Blueprint $table) {
            $table->dropColumn('estado_civil');
            $table->dropColumn('cor');
            $table->dropColumn('pai');
            $table->dropColumn('mae');
            $table->dropColumn('data_nascimento');
            $table->dropColumn('telefone');
            $table->dropColumn('idade');
            $table->dropColumn('naturalidade');
            $table->dropColumn('ocupacao');
            $table->dropColumn('obito_fetal');
            $table->dropColumn('idade_mae');
            $table->dropColumn('ocupacao_mae');
            $table->dropColumn('escolaridade_mae');
            $table->dropColumn('tipo_de_parto');
            $table->dropColumn('nm');
            $table->dropColumn('nv');
            $table->dropColumn('tempo_gestacao');
            $table->dropColumn('endereco_mae');
            $table->unsignedBigInteger('entrevista_id')->after('id_corpo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laudos', function (Blueprint $table) {
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
            $table->dropColumn('entrevista_id');
        });
    }
}
