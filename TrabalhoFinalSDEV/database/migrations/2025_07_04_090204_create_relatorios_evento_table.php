<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoriosEventoTable extends Migration
{
    public function up()
    {
        Schema::create('relatorios_evento', function (Blueprint $table) {

            $table->id();
            $table->integer('cod_servico');

            // Perguntas principais
            $table->boolean('houve_atraso')->nullable();
            $table->text('motivo_atraso')->nullable();
            $table->boolean('houve_incidentes')->nullable();
            $table->text('descricao_incidente')->nullable();
            $table->boolean('highlights_selecionados')->nullable();

            // Condições Quinta
            $table->tinyInteger('quinta_espaco')->nullable(); // 1-5 estrelas ou null (N/A)
            $table->tinyInteger('quinta_iluminacao')->nullable();
            $table->tinyInteger('quinta_estacionamento')->nullable();
            $table->tinyInteger('quinta_staff')->nullable();

            // Condições Igreja
            $table->tinyInteger('igreja_espaco')->nullable();
            $table->tinyInteger('igreja_iluminacao')->nullable();
            $table->tinyInteger('igreja_estacionamento')->nullable();

            // Observações
            $table->text('observacoes')->nullable();

            $table->timestamps();

            $table->foreign('cod_servico')->references('cod_servico')->on('servicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relatorios_evento');
    }
}
