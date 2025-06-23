<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'Marca';
    protected $primaryKey = 'cod_marca';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['marca'];

    public function materiais()
    {
        return $this->hasMany(Material::class, 'cod_marca', 'cod_marca');
    }
}
