<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function funcionario()
    {
    // belongsTo(Nome do Modelo Relacionado, Chave Estrangeira NESTA tabela, Chave Referenciada NA OUTRA tabela)
    return $this->belongsTo(Funcionario::class, 'cod_funcionario', 'cod_funcionario');
}
    public function isAdmin()
{
    // Verifica se este User tem um Funcionario associado através da relação ($this->funcionario)
    // E se o cod_nivel desse Funcionario é igual a 1.
    return $this->funcionario && $this->funcionario->cod_nivel === 1;
}
}
