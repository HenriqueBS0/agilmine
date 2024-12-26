<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembroRegra extends Model
{
    use HasFactory;

    protected $table = 'membro_regras';

    protected $fillable = [
        'membro',
        'regra',
    ];

    public function membro()
    {
        return $this->belongsTo(ProjetoMembro::class, 'membro');
    }
}
