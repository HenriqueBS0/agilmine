<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoConfiguracao extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projeto_configuracoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projeto_id',
        'metrica_usuario',
        'metrica_horas',
        'metrica_story_points',
        'cor_sprint_andamento',
        'cor_sprint_atrasada',
        'cor_sprint_concluida',
        'cor_sprint_concluida_atraso',
        'cor_sprint_cancelada',
        'cor_release_andamento',
        'cor_release_atrasada',
        'cor_release_concluida',
        'cor_release_concluida_atraso',
        'cor_release_cancelada',
    ];

    /**
     * Get the project associated with this configuration.
     */
    public function project()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }
}
