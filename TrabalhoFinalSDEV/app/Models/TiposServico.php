<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Servico;

class TiposServico extends Model
{
    use HasFactory;

    protected $table = 'TiposServico';
    protected $primaryKey = 'cod_tipo_servico';
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['nome_tipo'];

    public function servicos()
    {
        
        return $this->hasMany(Servico::class, 'cod_tipo_servico', 'cod_tipo_servico');
    }
}
