<?php

namespace App\Models;

use App\Models\Enums\EventoTipo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprintEvento extends Model
{
    use HasFactory;

    protected $fillable = [
        'sprint_id',
        'tipo',
        'descricao',
        'participantes',
        'data_hora',
    ];

    protected $casts = [
        'participantes' => 'array',
        'data_hora' => 'datetime',
        'tipo' => EventoTipo::class,
    ];

    public function getDescricaoTipo(): string
    {
        return $this->tipo->getDescricao();
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }
}
