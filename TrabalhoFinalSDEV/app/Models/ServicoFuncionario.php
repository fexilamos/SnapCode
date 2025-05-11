<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot; 
use App\Models\Servico;
use App\Models\Funcionario;



class ServicoFuncionario extends Pivot 
{
    use HasFactory;


    protected $table = 'Servico_Funcionario';
    protected $primaryKey = ['cod_servico', 'cod_funcionario'];
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'cod_servico',
        'cod_funcionario',
        'data_alocacao_inicio',
        'data_alocacao_fim',
        'funcao_no_servico',
    ];

     protected $casts = [
         'data_alocacao_inicio' => 'date',
         'data_alocacao_fim' => 'date',
     ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }

    public function funcionario()
    {

        return $this->belongsTo(Funcionario::class, 'cod_funcionario', 'cod_funcionario');
    }

}