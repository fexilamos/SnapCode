<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitsTable extends Migration
{
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->increments('cod_kit');
            $table->string('nome_kit', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kits');
    }
}
