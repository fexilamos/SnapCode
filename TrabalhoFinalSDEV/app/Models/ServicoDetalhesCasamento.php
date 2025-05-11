<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico; 

class ServicoDetalhesCasamento extends Model
{
    use HasFactory;

    protected $table = 'Servico_Detalhes_Casamento';
    protected $primaryKey = 'cod_servico'; 
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'cod_servico', 
        'fotos',
        'video',
        'drone',
        'sde',
        'fotos_convidados',
        'num_convidados_fotos',
        'venda_fotos',
        'hora_chegada_casa_noivo',
        'hora_saida_casa_noivo',
        'nome_noivo',
        'morada_noivo',
        'agregado_noivo',
        'info_extra_noivo',
        'hora_chegada_casa_noiva',
        'nome_noiva',
        'morada_noiva',
        'agregado_noiva',
        'info_extra_noiva',
        'morada_igreja',
        'instrucoes_igreja',
        'ordem_entrada',
        'coro',
        'coro_localizacao',
        'ordem_leituras',
        'oferta_ramo',
        'grupo_exterior',
        'instrucoes_saida_igreja',
        'info_extra_igreja',
        'nome_quinta',
        'morada_quinta',
        'instrucoes_quinta',
        'timeline',
    ];

     protected $casts = [
         'fotos' => 'boolean',
         'video' => 'boolean',
         'drone' => 'boolean',
         'sde' => 'boolean',
         'fotos_convidados' => 'boolean',
         'num_convidados_fotos' => 'integer',
         'venda_fotos' => 'boolean',
         'coro' => 'boolean',
         'oferta_ramo' => 'boolean',
         'grupo_exterior' => 'boolean',
     ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}
