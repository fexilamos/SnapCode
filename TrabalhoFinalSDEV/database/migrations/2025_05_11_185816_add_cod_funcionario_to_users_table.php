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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('cod_funcionario')
                  ->nullable()
                  ->after('id')
                  ->collation('utf8mb4_general_ci'); 

            $table->foreign('cod_funcionario')
                  ->references('cod_funcionario') 
                  ->on('funcionarios')           
                  ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cod_funcionario']);
            $table->dropColumn('cod_funcionario');
        });
    }
};
