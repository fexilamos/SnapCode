<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Funcao extends Model
{
    use HasFactory;
    protected $table = 'Funcao';
    protected $primaryKey = 'cod_funcao';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['cod_funcao', 'funcao'];

     public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cod_funcao', 'cod_funcao');
    }
}
