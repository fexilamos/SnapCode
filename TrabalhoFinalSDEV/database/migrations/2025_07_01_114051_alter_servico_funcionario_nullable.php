<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('servico_funcionario', function (Blueprint $table) {
            $table->dateTime('data_alocacao_fim')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servico_funcionario', function (Blueprint $table) {
            $table->dateTime('data_alocacao_fim')->nullable(false)->change();
        });
    }
};
