<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot; 
use App\Models\Servico;
use App\Models\Material;



class ServicoEquipamento extends Pivot 
{
    use HasFactory;

    protected $table = 'Servico_Equipamento';
    protected $primaryKey = ['cod_servico', 'cod_material'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'cod_servico',
        'cod_material',
        'data_levantamento',
        'data_devolucao',
    ];

     protected $casts = [
         'data_levantamento' => 'date',
         'data_devolucao' => 'date',
     ];

    public function servico()
    {

        return $this->belongsTo(Servico::class, 'cod_servico', 'cod_servico');
    }

    public function material()
    {

        return $this->belongsTo(Material::class, 'cod_material', 'cod_material');
    }
}
