<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamesDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exames_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exame_id');
            $table->string('name', 100);
            $table->string('format', 5);
            $table->string('path', 150);
            $table->unsignedBigInteger('enviado_por');
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
        Schema::dropIfExists('exames_documentos');
    }
}
