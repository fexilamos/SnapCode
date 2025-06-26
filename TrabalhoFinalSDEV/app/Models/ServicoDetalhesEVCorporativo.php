<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico;

class ServicoDetalhesEvCorporativo extends Model
{
    use HasFactory;

    protected $table = 'servico_detalhes_evcorporativo';
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
        'hora_chegada_corp',
        'info_extra_corp',
    ];

     protected $casts = [
         'fotos' => 'boolean',
         'video' => 'boolean',
         'drone' => 'boolean',
         'sde' => 'boolean',
     ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}
