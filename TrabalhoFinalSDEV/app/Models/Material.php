<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\MaterialEstado;
use App\Models\Avaria;
use App\Models\Perda;
use App\Models\ServicoEquipamento;
use App\Models\Servico;

class Material extends Model
{
     use HasFactory;

    protected $table = 'Material';
    protected $primaryKey = 'cod_material';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'cod_material',
        'cod_categoria',
        'cod_marca',
        'cod_modelo',
        'num_serie',
        'cod_estado',
        'observacoes',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cod_categoria', 'cod_categoria');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'cod_marca', 'cod_marca');
    }
    public function modelo()
    {

        return $this->belongsTo(Modelo::class, 'cod_modelo', 'cod_modelo');
    }
    public function estado()
    {
        return $this->belongsTo(MaterialEstado::class, 'cod_estado', 'cod_estado');
    }

    public function avarias()
    {
        return $this->hasMany(Avaria::class, 'cod_material', 'cod_material');
    }

    public function perdas()
    {
        return $this->hasMany(Perda::class, 'cod_material', 'cod_material');
    }


    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'Servico_Equipamento', 'cod_material', 'cod_servico')
            ->withPivot('data_levantamento', 'data_devolucao')
            ->withTimestamps()
            ->using(ServicoEquipamento::class);
    }

     public function kits()
    {
        return $this->belongsToMany(Kit::class, 'kit_material', 'cod_material', 'cod_kit')
                    ->withPivot('quantidade');
    }
}
