<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'resumo',
        'data_inicio',
        'data_fim',
        'gera_release',
        'tarefas',
        'project_id',
        'versao',
        'resumo_release',
        'cancelada'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'gera_release' => 'boolean',
        'tarefas' => 'array',
        'cancelada' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Sprint $sprint) {
            $ultimoSerial = self::where('project_id', $sprint->project_id)->max('serial');

            $sprint->serial = $ultimoSerial ? $ultimoSerial + 1 : 1;
        });
    }

    /**
     * Set the tarefas attribute as an array of integers.
     *
     * @param  array|string  $value
     * @return void
     */
    public function setTarefasAttribute($value)
    {
        // Garante que os itens da lista sejam inteiros
        $this->attributes['tarefas'] = json_encode(array_unique(array_map('intval', (array) $value)));
    }

    /**
     * Get the tarefas attribute as an array of integers.
     *
     * @param  string $value
     * @return array
     */
    public function getTarefasAttribute($value)
    {
        // Decodifica a string JSON e transforma em inteiros
        return array_map('intval', json_decode($value, true) ?? []);
    }

    /**
     * Get the start date as a DateTime instance.
     *
     * @param  string $value
     * @return \Carbon\Carbon
     */
    public function getDataInicioAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Get the end date as a DateTime instance.
     *
     * @param  string $value
     * @return \Carbon\Carbon
     */
    public function getDataFimAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'project_id');
    }

    public function eventos()
    {
        return $this->hasMany(SprintEvento::class);
    }
}
