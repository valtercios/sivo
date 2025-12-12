<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('loginhash')->nullable();
            $table->string('crm', 50)->nullable();
            $table->integer('cadastrado_por')->nullable();
            $table->string('image')->nullable();
            $table->integer('setor_id')->nullable();
            $table->integer('tipo_user_id')->nullable();
            $table->integer('editado_por')->nullable();
            $table->integer('atualizacao')->nullable()->default('0');
            $table->integer('status')->nullable();
            $table->integer('processos_view')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->integer('current_team_id')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
