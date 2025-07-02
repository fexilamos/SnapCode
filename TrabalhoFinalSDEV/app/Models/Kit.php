<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kits';
    protected $primaryKey = 'cod_kit';
    public $timestamps = false;

    protected $fillable = [
        'nome_kit',
    ];
    public function materiais()
    {
        return $this->belongsToMany(Material::class, 'kit_material', 'cod_kit', 'cod_material')
            ->withPivot('quantidade');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_kit', 'cod_kit', 'cod_servico')
            ->using(\App\Models\ServicoKitPivot::class);
    }
}
