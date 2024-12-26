<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoMembro extends Model
{
    use HasFactory;

    protected $table = 'projeto_membros';

    protected $fillable = [
        'projeto_id',
        'membro',
        'nome'
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }

    public function regras()
    {
        return $this->hasMany(MembroRegra::class, 'membro');
    }
}
