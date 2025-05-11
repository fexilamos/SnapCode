<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'Modelo';
    protected $primaryKey = 'cod_modelo';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['modelo'];

    public function materiais()
    {
        return $this->hasMany(Material::class, 'cod_modelo', 'cod_modelo');
    }
}
