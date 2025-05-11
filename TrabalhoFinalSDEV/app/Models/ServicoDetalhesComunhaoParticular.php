<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico; 

class ServicoDetalhesComunhaoParticular extends Model
{
    use HasFactory;

    protected $table = 'Servico_Detalhes_ComunhaoParticular';
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
        'hora_chegada_casa_crianca',
        'hora_saida_casa_crianca',
        'nome_crianca',
        'morada_crianca',
        'agregado_crianca',
        'info_extra_crianca',
        'morada_igreja',
        'instrucoes_igreja',
        'coro',
        'coro_localizacao',
        'grupo_exterior',
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
         'grupo_exterior' => 'boolean',
     ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}