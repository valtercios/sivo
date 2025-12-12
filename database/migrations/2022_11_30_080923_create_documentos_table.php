<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('format', 10);
            $table->string('path', 100);
            $table->integer('enviado_por');
            $table->integer('tipo_documento');
            $table->string('papel_documento', 50);
            $table->unsignedBigInteger('corpo_id')->nullable();
            $table->foreign('corpo_id')->references('id')->on('corpos');

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
        Schema::dropIfExists('documentos');
    }
}
