<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Servico;


class Perda extends Model
{
    use HasFactory;

    protected $table = 'Perdas';
    protected $primaryKey = 'cod_perda';
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