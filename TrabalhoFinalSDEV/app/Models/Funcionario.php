<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nivel;
use App\Models\Funcao;
use App\Models\FuncionarioEstado;
use App\Models\ServicoFuncionario;
use App\Models\User; 
use App\Models\Servico;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'Funcionarios';
    protected $primaryKey = 'cod_funcionario';
    protected $keyType = 'int';
    

     protected $fillable = [
        'cod_nivel',
        'nome',
        'telefone',
        'mail',
        'morada',
        'cod_funcao',
        'cod_estado',
        'pilota_drone',
        'tem_equipamento_proprio'];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'cod_nivel', 'cod_nivel');
    }

    public function funcao()
    {
        return $this->belongsTo(Funcao::class, 'cod_funcao', 'cod_funcao');
    }

    public function estado()
    {
        return $this->belongsTo(FuncionarioEstado::class, 'cod_estado', 'cod_estado');
    }

    public function user()
    {
         return $this->hasOne(User::class, 'cod_funcionario', 'cod_funcionario');
    }

    public function servicoFuncionarios()
    {
         return $this->hasMany(ServicoFuncionario::class, 'cod_funcionario', 'cod_funcionario');
    }
     public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'Servico_Funcionario', 'cod_funcionario', 'cod_servico')
                    ->using(ServicoFuncionario::class);
    }
}
