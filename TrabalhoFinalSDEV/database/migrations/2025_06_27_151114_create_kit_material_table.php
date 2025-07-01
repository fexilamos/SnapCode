<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('kit_material', function (Blueprint $table) {
            $table->unsignedInteger('cod_kit');
            $table->string('cod_material', 25)->collation('utf8mb4_general_ci');
            $table->unsignedInteger('quantidade')->default(1);

            $table->primary(['cod_kit', 'cod_material']);
            $table->foreign('cod_kit')->references('cod_kit')->on('kits')->onDelete('cascade');
            $table->foreign('cod_material')->references('cod_material')->on('Material')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kit_material');
    }
}
