<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (Projeto $projeto) {
            ProjetoConfiguracao::create(['projeto_id' => $projeto->id]);
        });
    }

    public function membros(): HasMany
    {
        return $this->hasMany(ProjetoMembro::class, 'projeto_id');
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class, 'project_id');
    }

    public function configuracao(): HasOne
    {
        return $this->hasOne(ProjetoConfiguracao::class, 'projeto_id');
    }

    public function setTarefasAttribute(array $value): void
    {
        $this->attributes['tarefas'] = json_encode(array_unique($value));
    }

    public function getTarefasAttribute($value): array
    {
        return $value ? array_map('intval', json_decode($value, true)) : [];
    }
}
