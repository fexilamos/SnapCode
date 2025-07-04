<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Servico;

class RelatorioEvento extends Model
{
    protected $table = 'relatorios_evento';

    protected $fillable = [
        'cod_servico',
        'houve_atraso',
        'motivo_atraso',
        'houve_incidentes',
        'descricao_incidente',
        'highlights_selecionados',
        'quinta_espaco',
        'quinta_iluminacao',
        'quinta_estacionamento',
        'quinta_staff',
        'igreja_espaco',
        'igreja_iluminacao',
        'igreja_estacionamento',
        'observacoes'
    ];

    // RELAÇÃO COM SERVICO
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}
