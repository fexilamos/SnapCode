<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Funcionario;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'Nivel';
    protected $primaryKey = 'cod_nivel';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['cod_nivel','nivel'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cod_nivel', 'cod_nivel');
    }
}
