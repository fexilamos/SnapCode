<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico; 

class ServicoDetalhesComunhaoGeral extends Model
{
    use HasFactory;

    protected $table = 'Servico_Detalhes_ComunhaoGeral';
    protected $primaryKey = 'cod_servico'; 
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'cod_servico', 
        'video',
        'drone',
        'sde',
        'formato_fotos',
        'valor_foto',
        'formato_video',
        'valor_video',
        'hora_chegada_igreja',
        'num_criancas',
        'info_extra_comunhao',
        'coro',
        'coro_localizacao',
        'diplomas',
        'grupo_exterior',
    ];

     protected $casts = [
         'fotos' => 'boolean',
         'video' => 'boolean',
         'drone' => 'boolean',
         'sde' => 'boolean',
         'valor_foto' => 'decimal:2', 
         'valor_video' => 'decimal:2',
         'num_criancas' => 'integer',
         'coro' => 'boolean',
         'diplomas' => 'boolean',
         'grupo_exterior' => 'boolean',
     ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}
