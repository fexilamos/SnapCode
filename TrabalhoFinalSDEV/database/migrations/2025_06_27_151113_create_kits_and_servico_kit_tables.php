<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitsAndServicoKitTables extends Migration
{
    public function up()
    {
        // Tabela Kits
        Schema::create('kits', function (Blueprint $table) {
            $table->increments('cod_kit');
            $table->string('nome_kit', 100);
        });

        // Tabela Kit_Material (pivot Kit <-> Material)
        Schema::create('kit_material', function (Blueprint $table) {
            $table->unsignedInteger('cod_kit');
            $table->string('cod_material', 25);
            $table->unsignedInteger('quantidade')->default(1);

            $table->primary(['cod_kit', 'cod_material']);

            $table->foreign('cod_kit')->references('cod_kit')->on('kits')->onDelete('cascade');
            $table->foreign('cod_material')->references('cod_material')->on('Material')->onDelete('cascade');
        });

        // Tabela Servico_Kit (pivot Servico <-> Kit)
        Schema::create('servico_kit', function (Blueprint $table) {
            $table->unsignedInteger('cod_servico');
            $table->unsignedInteger('cod_kit');
            $table->primary(['cod_servico', 'cod_kit']);

            $table->foreign('cod_servico')->references('cod_servico')->on('servicos')->onDelete('cascade');
            $table->foreign('cod_kit')->references('cod_kit')->on('Kits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servico_kit');
        Schema::dropIfExists('kit_material');
        Schema::dropIfExists('kits');
    }
}
