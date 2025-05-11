<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Servico;


class Avaria extends Model
{
    use HasFactory;
    
    protected $table = 'Avarias';
    protected $primaryKey = 'cod_avaria';
    protected $keyType = 'int';
    public $timestamps = false;

     protected $fillable = [
        'cod_material',
        'cod_servico', 
        'data_registo',
        'observacoes', 
    ];

    protected $casts = [
        'data_registo' => 'date',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'cod_material', 'cod_material');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }
}