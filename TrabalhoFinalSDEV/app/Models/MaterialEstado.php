<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Material;

class MaterialEstado extends Model
{
    use HasFactory;


    protected $table = 'Material_Estado';
    protected $primaryKey = 'cod_estado';
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['estado_nome'];

    public function materiais()
    {
        return $this->hasMany(Material::class, 'cod_estado', 'cod_estado');
    }
}
