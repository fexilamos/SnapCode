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
    }
}
