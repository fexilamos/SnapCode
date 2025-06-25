<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
     Schema::create('funcionario_funcao', function (Blueprint $table) {
    $table->integer('cod_funcionario');
    $table->integer('cod_funcao');
    $table->foreign('cod_funcionario')->references('cod_funcionario')->on('funcionarios')->onDelete('cascade');
    $table->foreign('cod_funcao')->references('cod_funcao')->on('funcao')->onDelete('cascade');
    $table->primary(['cod_funcionario', 'cod_funcao']);
});
    }

    public function down()
    {
        Schema::dropIfExists('funcionario_funcao');
    }
};
