<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projeto extends Model
{
    use HasFactory;

    /**
     * Define que a chave primária não é auto-increment.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'arquivado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'arquivado' => 'boolean'
    ];

    public function membros(): HasMany
    {
        return $this->hasMany(ProjetoMembro::class, 'projeto_id');
    }
}
