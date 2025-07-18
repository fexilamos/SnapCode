<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicoKitTable extends Migration
{
    public function up()
    {
        Schema::create('servico_kit', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_servico');
            $table->unsignedInteger('cod_kit');
            $table->dateTime('data_levantamento')->nullable();
            $table->dateTime('data_devolucao')->nullable();
            $table->foreign('cod_servico')->references('cod_servico')->on('Servicos')->onDelete('cascade');
            $table->foreign('cod_kit')->references('cod_kit')->on('kits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servico_kit');
    }
}
