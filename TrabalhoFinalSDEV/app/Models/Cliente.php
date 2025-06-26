<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Servico;

class Cliente extends Model
{
     use HasFactory;

    protected $table = 'Clientes';
    protected $primaryKey = 'cod_cliente';
    protected $keyType = 'int';
    public $timestamps = false;


    protected $fillable = ['nome', 'telefone', 'mail'];

    public function servicos()
    {

        return $this->hasMany(Servico::class, 'cod_cliente', 'cod_cliente');
    }
}
