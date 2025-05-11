<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Material;

class Categoria extends Model
{
    use HasFactory;
    protected $primaryKey = 'cod_categoria';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['categoria'];

 public function materiais()
    {
        
        return $this->hasMany(Material::class, 'cod_categoria', 'cod_categoria');
    }
}
