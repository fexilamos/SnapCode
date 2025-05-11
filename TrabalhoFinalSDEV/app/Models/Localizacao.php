<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico;

class Localizacao extends Model
{
    use HasFactory;

    protected $table = 'Localizacoes';
    protected $primaryKey = 'cod_local_servico';
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['nome_local'];

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'cod_local_servico', 'cod_local_servico');
    }
}
