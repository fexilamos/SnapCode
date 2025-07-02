<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cliente;
use App\Models\TiposServico;
use App\Models\Localizacao;
use App\Models\Avaria;
use App\Models\Perda;
use App\Models\ServicoDetalhesCasamento;
use App\Models\ServicoDetalhesBatizado;
use App\Models\ServicoDetalhesComunhaoParticular;
use App\Models\ServicoDetalhesComunhaoGeral;
use App\Models\ServicoDetalhesEvCorporativo;
use App\Models\ServicoFuncionario;
use App\Models\Funcionario;
use App\Models\ServicoKitPivot;


class Servico extends Model
{
    use HasFactory;

    protected $table = 'Servicos';
    protected $primaryKey = 'cod_servico';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'cod_cliente',
        'cod_tipo_servico',
        'cod_local_servico',
        'data_inicio',
        'data_fim',
        'nome_servico',
        'mail',
        'telefone',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cod_cliente', 'cod_cliente');
    }

    public function tipoServico()
    {
        return $this->belongsTo(TiposServico::class, 'cod_tipo_servico', 'cod_tipo_servico');
    }

    public function localizacao()
    {

        return $this->belongsTo(Localizacao::class, 'cod_local_servico', 'cod_local_servico');
    }

    public function avarias()
    {

        return $this->hasMany(Avaria::class, 'cod_servico', 'cod_servico');
    }

    public function perdas()
    {

        return $this->hasMany(Perda::class, 'cod_servico', 'cod_servico');
    }

    public function detalhesCasamento()
    {
        return $this->hasOne(ServicoDetalhesCasamento::class, 'cod_servico', 'cod_servico');
    }
    public function detalhesBatizado()
    {
        return $this->hasOne(ServicoDetalhesBatizado::class, 'cod_servico', 'cod_servico');
    }
    public function detalhesComunhaoParticular()
    {
        return $this->hasOne(ServicoDetalhesComunhaoParticular::class, 'cod_servico', 'cod_servico');
    }
    public function detalhesComunhaoGeral()
    {
        return $this->hasOne(ServicoDetalhesComunhaoGeral::class, 'cod_servico', 'cod_servico');
    }
    public function detalhesEvCorporativo()
    {
        return $this->hasOne(ServicoDetalhesEvCorporativo::class, 'cod_servico', 'cod_servico');
    }

   public function funcionarios()
{
    return $this->belongsToMany(Funcionario::class, 'servico_funcionario', 'cod_servico', 'cod_funcionario')
        ->withPivot(['data_alocacao_inicio', 'funcao_no_servico']);
}


    public function kits()
{
    return $this->belongsToMany(Kit::class, 'servico_kit', 'cod_servico', 'cod_kit')
        ->using(ServicoKitPivot::class)
        ->withPivot(['id','data_levantamento', 'data_devolucao']);
}
}
