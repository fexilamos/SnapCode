<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Funcionario;

class FuncionarioEstado extends Model
{
    use HasFactory;

    protected $table = 'Funcionario_Estado';
    protected $primaryKey = 'cod_estado';
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['estado_nome'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cod_estado', 'cod_estado');
    }
}
