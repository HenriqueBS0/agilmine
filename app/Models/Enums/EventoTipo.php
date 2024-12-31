<?php

namespace App\Models\Enums;

enum EventoTipo: int
{
    case PLANEJAMENTO = 1;
    case DIARIA = 2;
    case SEMANAL = 3;
    case REVISAO = 4;
    case RETROSPECTIVA = 5;

    /**
     * Retorna a descrição do status.
     *
     * @return string
     */
    public function getDescricao(): string
    {
        return match ($this) {
            self::PLANEJAMENTO => 'Planejamento',
            self::DIARIA => 'Diária',
            self::SEMANAL => 'Semanal',
            self::REVISAO => 'Revisao',
            self::RETROSPECTIVA => 'Retrospectiva',
        };
    }
}