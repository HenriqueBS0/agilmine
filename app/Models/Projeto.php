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
        'tarefas'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'arquivado' => 'boolean',
        'tarefas' => 'array'
    ];

    public function membros(): HasMany
    {
        return $this->hasMany(ProjetoMembro::class, 'projeto_id');
    }

    /**
     * Set the tarefas attribute ensuring the IDs are unique.
     *
     * @param array $value
     * @return void
     */
    public function setTarefasAttribute(array $value): void
    {
        $this->attributes['tarefas'] = json_encode(array_unique($value));
    }

    /**
     * Get the tarefas attribute as an array of integers.
     *
     * @param string|null $value
     * @return array
     */
    public function getTarefasAttribute($value): array
    {
        return $value ? array_map('intval', json_decode($value, true)) : [];
    }
}
