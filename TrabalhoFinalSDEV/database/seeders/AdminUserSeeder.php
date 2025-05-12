<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Nivel;
use App\Models\Funcao;
use App\Models\FuncionarioEstado;
use App\Models\Funcionario;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nivelAdmin = Nivel::firstOrCreate(
            ['cod_nivel' => 1],
            ['nivel' => 'Admin']
        );
        $funcaoTeste = Funcao::firstOrCreate(
            ['cod_funcao' => 0],
            ['funcao' => 'Admin']
        );
        $estadoTeste = FuncionarioEstado::firstOrCreate(
             ['cod_estado' => 1],
             ['estado_nome' => 'Ativo']
        );
        $adminFuncionario = Funcionario::firstOrCreate(
            ['telefone' => '999888777'],
            [
                'cod_nivel' => $nivelAdmin->cod_nivel,
                'nome' => 'AdminTest',
                'mail' => 'admintest@snap.com',
                'cod_funcao' => $funcaoTeste->cod_funcao,
                'cod_estado' => $estadoTeste->cod_estado,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admintest@snap.com'],
            [
                'name' => 'AdminTest',
                'password' => Hash::make('password'),
                'cod_funcionario' => $adminFuncionario->cod_funcionario,
            ]
        );

        $this->command->info('Utilizador Admin de teste criado/verificado!');
    }
}
