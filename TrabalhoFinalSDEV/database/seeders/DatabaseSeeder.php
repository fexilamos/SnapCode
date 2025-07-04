<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AdminUserSeeder::class);

        DB::table('Marca')->insert([
            ['cod_marca' => 13, 'marca' => 'Genérica'],
            ['cod_marca' => 14, 'marca' => 'Epson'],
            ['cod_marca' => 15, 'marca' => 'Dell'],
            ['cod_marca' => 16, 'marca' => 'HP'],
            ['cod_marca' => 17, 'marca' => 'Elite Screens'],
        ]);

        // Inserir Modelos
        DB::table('Modelo')->insert([
            ['cod_modelo' => 36, 'modelo' => 'HDMI 2.0'],
            ['cod_modelo' => 37, 'modelo' => 'EH-TW5400'],
            ['cod_modelo' => 38, 'modelo' => 'Latitude 5520'],
            ['cod_modelo' => 39, 'modelo' => 'LaserJet Pro'],
            ['cod_modelo' => 40, 'modelo' => 'Manual 120'],
        ]);


        // Inserir Materiais Acessórios
        DB::table('Material')->insert([
            // Cabo HDMI x5
            ['cod_material' => 'MAT219', 'cod_categoria' => 'ACCS', 'cod_marca' => 13, 'cod_modelo' => 36, 'num_serie' => 'HDMI001', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT220', 'cod_categoria' => 'ACCS', 'cod_marca' => 13, 'cod_modelo' => 36, 'num_serie' => 'HDMI002', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT221', 'cod_categoria' => 'ACCS', 'cod_marca' => 13, 'cod_modelo' => 36, 'num_serie' => 'HDMI003', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT222', 'cod_categoria' => 'ACCS', 'cod_marca' => 13, 'cod_modelo' => 36, 'num_serie' => 'HDMI004', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT223', 'cod_categoria' => 'ACCS', 'cod_marca' => 13, 'cod_modelo' => 36, 'num_serie' => 'HDMI005', 'cod_estado' => 1, 'observacoes' => ''],
            
            // Projetor x3
            ['cod_material' => 'MAT224', 'cod_categoria' => 'ACCS', 'cod_marca' => 14, 'cod_modelo' => 37, 'num_serie' => 'PROJ001', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT225', 'cod_categoria' => 'ACCS', 'cod_marca' => 14, 'cod_modelo' => 37, 'num_serie' => 'PROJ002', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT226', 'cod_categoria' => 'ACCS', 'cod_marca' => 14, 'cod_modelo' => 37, 'num_serie' => 'PROJ003', 'cod_estado' => 1, 'observacoes' => ''],
            
            // Computador x4
            ['cod_material' => 'MAT227', 'cod_categoria' => 'ACCS', 'cod_marca' => 15, 'cod_modelo' => 38, 'num_serie' => 'COMP001', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT228', 'cod_categoria' => 'ACCS', 'cod_marca' => 15, 'cod_modelo' => 38, 'num_serie' => 'COMP002', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT229', 'cod_categoria' => 'ACCS', 'cod_marca' => 15, 'cod_modelo' => 38, 'num_serie' => 'COMP003', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT230', 'cod_categoria' => 'ACCS', 'cod_marca' => 15, 'cod_modelo' => 38, 'num_serie' => 'COMP004', 'cod_estado' => 1, 'observacoes' => ''],
            
            // Impressora x2
            ['cod_material' => 'MAT231', 'cod_categoria' => 'ACCS', 'cod_marca' => 16, 'cod_modelo' => 39, 'num_serie' => 'IMP001', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT232', 'cod_categoria' => 'ACCS', 'cod_marca' => 16, 'cod_modelo' => 39, 'num_serie' => 'IMP002', 'cod_estado' => 1, 'observacoes' => ''],
            
            // Tela de projeção x3
            ['cod_material' => 'MAT233', 'cod_categoria' => 'ACCS', 'cod_marca' => 17, 'cod_modelo' => 40, 'num_serie' => 'TELA001', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT234', 'cod_categoria' => 'ACCS', 'cod_marca' => 17, 'cod_modelo' => 40, 'num_serie' => 'TELA002', 'cod_estado' => 1, 'observacoes' => ''],
            ['cod_material' => 'MAT235', 'cod_categoria' => 'ACCS', 'cod_marca' => 17, 'cod_modelo' => 40, 'num_serie' => 'TELA003', 'cod_estado' => 1, 'observacoes' => ''],
        ]);

        // Inserir Kits
        DB::table('kits')->insert([
            ['cod_kit' => 1, 'nome_kit' => 'Kit Foto'],
            ['cod_kit' => 2, 'nome_kit' => 'Kit Video'],
            ['cod_kit' => 3, 'nome_kit' => 'Kit Foto e Video'],
        ]);

        // Inserir Kit_Material
        DB::table('kit_material')->insert([
            // Kit 1: Kit Foto
            ['cod_kit' => 1, 'cod_material' => 'MAT006', 'quantidade' => 1], // Câmara Canon
            ['cod_kit' => 1, 'cod_material' => 'MAT028', 'quantidade' => 1], // Lente Canon
            ['cod_kit' => 1, 'cod_material' => 'MAT040', 'quantidade' => 2], // Bateria Canon x2
            ['cod_kit' => 1, 'cod_material' => 'MAT088', 'quantidade' => 1], // Iluminação
            ['cod_kit' => 1, 'cod_material' => 'MAT070', 'quantidade' => 1], // Cartão de memória
            ['cod_kit' => 1, 'cod_material' => 'MAT108', 'quantidade' => 1], // Mochila
            
            // Kit 2: Kit Video
            ['cod_kit' => 2, 'cod_material' => 'MAT010', 'quantidade' => 1], // Câmara Sony
            ['cod_kit' => 2, 'cod_material' => 'MAT032', 'quantidade' => 1], // Lente Sony
            ['cod_kit' => 2, 'cod_material' => 'MAT044', 'quantidade' => 1], // Bateria Sony
            ['cod_kit' => 2, 'cod_material' => 'MAT080', 'quantidade' => 1], // Tripé
            ['cod_kit' => 2, 'cod_material' => 'MAT071', 'quantidade' => 1], // Cartão de memória
            ['cod_kit' => 2, 'cod_material' => 'MAT096', 'quantidade' => 1], // Microfone
            ['cod_kit' => 2, 'cod_material' => 'MAT109', 'quantidade' => 1], // Mochila
            
            // Kit 3: Kit Foto e Video
            ['cod_kit' => 3, 'cod_material' => 'MAT100', 'quantidade' => 1], // Drone
            ['cod_kit' => 3, 'cod_material' => 'MAT012', 'quantidade' => 2], // Câmara Fujifilm x2
            ['cod_kit' => 3, 'cod_material' => 'MAT034', 'quantidade' => 2], // Lente Fujifilm x2
            ['cod_kit' => 3, 'cod_material' => 'MAT046', 'quantidade' => 3], // Bateria Fujifilm x3
            ['cod_kit' => 3, 'cod_material' => 'MAT072', 'quantidade' => 2], // Cartão de memória x2
            ['cod_kit' => 3, 'cod_material' => 'MAT081', 'quantidade' => 1], // Tripé
            ['cod_kit' => 3, 'cod_material' => 'MAT089', 'quantidade' => 1], // Iluminação
            ['cod_kit' => 3, 'cod_material' => 'MAT110', 'quantidade' => 1], // Mochila

            
        ]);

        // Inserir Kits adicionais (sem repetir materiais dos kits 1, 2 e 3)
        DB::table('kits')->insert([
            ['cod_kit' => 4, 'nome_kit' => 'Kit Canon Completo'],
            ['cod_kit' => 5, 'nome_kit' => 'Kit Computador Impressão'],
            ['cod_kit' => 6, 'nome_kit' => 'Kit Projeção'],
        ]);

        // Inserir Kit_Material para os novos kits (materiais não usados nos kits 1, 2 e 3)
        DB::table('kit_material')->insert([
            // Kit 4: Kit Canon Completo
            ['cod_kit' => 4, 'cod_material' => 'MAT219', 'quantidade' => 1], // Mochila (HDMI001, Genérica)
            ['cod_kit' => 4, 'cod_material' => 'MAT231', 'quantidade' => 1], // Impressora (Canon)
            ['cod_kit' => 4, 'cod_material' => 'MAT223', 'quantidade' => 1], // Bateria (Genérica)
            ['cod_kit' => 4, 'cod_material' => 'MAT220', 'quantidade' => 1], // Lente (Genérica)
            ['cod_kit' => 4, 'cod_material' => 'MAT221', 'quantidade' => 1], // Cartão de memória (Genérica)
            ['cod_kit' => 4, 'cod_material' => 'MAT224', 'quantidade' => 1], // Câmara (Epson)
            ['cod_kit' => 4, 'cod_material' => 'MAT233', 'quantidade' => 1], // Tela de projeção

            // Kit 5: Kit Computador Impressão
            ['cod_kit' => 5, 'cod_material' => 'MAT227', 'quantidade' => 1], // Computador (Dell)
            ['cod_kit' => 5, 'cod_material' => 'MAT228', 'quantidade' => 1], // Computador (Dell)
            ['cod_kit' => 5, 'cod_material' => 'MAT231', 'quantidade' => 1], // Impressora (Canon)
            ['cod_kit' => 5, 'cod_material' => 'MAT232', 'quantidade' => 1], // Impressora (HP)
            ['cod_kit' => 5, 'cod_material' => 'MAT234', 'quantidade' => 1], // Tela de projeção
            ['cod_kit' => 5, 'cod_material' => 'MAT229', 'quantidade' => 1], // Computador (Dell)
            ['cod_kit' => 5, 'cod_material' => 'MAT222', 'quantidade' => 1], // Mochila (Genérica)

            // Kit 6: Kit Projeção
            ['cod_kit' => 6, 'cod_material' => 'MAT225', 'quantidade' => 1], // Projetor (Epson)
            ['cod_kit' => 6, 'cod_material' => 'MAT226', 'quantidade' => 1], // Projetor (Epson)
            ['cod_kit' => 6, 'cod_material' => 'MAT235', 'quantidade' => 1], // Tela de projeção (Elite Screens)
            ['cod_kit' => 6, 'cod_material' => 'MAT230', 'quantidade' => 1], // Computador (Dell)
            ['cod_kit' => 6, 'cod_material' => 'MAT223', 'quantidade' => 1], // Bateria (Genérica)
            ['cod_kit' => 6, 'cod_material' => 'MAT221', 'quantidade' => 1], // Cartão de memória (Genérica)
            ['cod_kit' => 6, 'cod_material' => 'MAT220', 'quantidade' => 1], // Lente (Genérica)
            ['cod_kit' => 5, 'cod_material' => 'MAT111', 'quantidade' => 1], // Mochila (Genérica)
        ]);

        // Inserir na tabela servico_funcionario
        DB::table('servico_funcionario')->insert([
            [
                'cod_servico' => 18,
                'cod_funcionario' => 1, // João Silva
                'data_alocacao_inicio' => '2024-06-15',
                'data_alocacao_fim' => '2024-06-15',
                'funcao_no_servico' => 'Fotógrafo Principal'
            ],
            [
                'cod_servico' => 18,
                'cod_funcionario' => 2, // Maria Santos
                'data_alocacao_inicio' => '2024-06-15',
                'data_alocacao_fim' => '2024-06-15',
                'funcao_no_servico' => 'Videomaker'
            ],
            [
                'cod_servico' => 19,
                'cod_funcionario' => 3, // Pedro Oliveira
                'data_alocacao_inicio' => '2024-07-20',
                'data_alocacao_fim' => '2024-07-20',
                'funcao_no_servico' => 'Fotógrafo Principal'
            ],
            [
                'cod_servico' => 19,
                'cod_funcionario' => 4, // Ana Costa
                'data_alocacao_inicio' => '2024-07-20',
                'data_alocacao_fim' => '2024-07-20',
                'funcao_no_servico' => 'Assistente'
            ],
            [
                'cod_servico' => 20,
                'cod_funcionario' => 5, // Carlos Mendes
                'data_alocacao_inicio' => '2024-08-10',
                'data_alocacao_fim' => '2024-08-10',
                'funcao_no_servico' => 'Operador de Drone'
            ],
            [
                'cod_servico' => 21,
                'cod_funcionario' => 1, // João Silva (pode repetir em serviços diferentes)
                'data_alocacao_inicio' => '2024-09-05',
                'data_alocacao_fim' => '2024-09-05',
                'funcao_no_servico' => 'Videomaker'
            ]
        ]);

        // Inserir na tabela servico_kit (com coluna id auto-increment)
        DB::table('servico_kit')->insert([
            [
                'cod_servico' => 18,
                'cod_kit' => 1, // Kit Foto
                'data_levantamento' => '2024-06-14',
                'data_devolucao' => '2024-06-16'
            ],
            [
                'cod_servico' => 18,
                'cod_kit' => 2, // Kit Video
                'data_levantamento' => '2024-06-14',
                'data_devolucao' => '2024-06-16'
            ],
            [
                'cod_servico' => 19,
                'cod_kit' => 3, // Kit Foto e Video
                'data_levantamento' => '2024-07-19',
                'data_devolucao' => '2024-07-21'
            ],
            [
                'cod_servico' => 20,
                'cod_kit' => 1, // Kit Foto (pode repetir em serviços diferentes)
                'data_levantamento' => '2024-08-09',
                'data_devolucao' => '2024-08-11'
            ],
            [
                'cod_servico' => 21,
                'cod_kit' => 2, // Kit Video
                'data_levantamento' => '2024-09-04',
                'data_devolucao' => '2024-09-06'
            ],
            [
                'cod_servico' => 22,
                'cod_kit' => 3, // Kit Foto e Video
                'data_levantamento' => '2024-10-11',
                'data_devolucao' => '2024-10-13'
            ]
        ]);
    }
}
