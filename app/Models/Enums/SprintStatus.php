<?php

namespace App\Models\Enums;

enum SprintStatus: int
{
    case EM_ANDAMENTO = 1;
    case EM_ANDAMENTO_ATRASADA = 2;
    case CANCELADA = 3;
    case CONCLUIDA = 4;

    /**
     * Retorna a descrição do status.
     *
     * @return string
     */
    public function getDescricao(): string
    {
        return match ($this) {
            self::EM_ANDAMENTO => 'Em Andamento',
            self::EM_ANDAMENTO_ATRASADA => 'Em Andamento (Atrasada)',
            self::CANCELADA => 'Cancelada',
            self::CONCLUIDA => 'Concluída',
        };
    }

    /**
     * Verifica se o status é "Em Andamento" ou "Em Andamento (Atrasada)".
     *
     * @return bool
     */
    public function isEmAndamento(): bool
    {
        return in_array($this, [self::EM_ANDAMENTO, self::EM_ANDAMENTO_ATRASADA], true);
    }

    /**
     * Verifica se o status é "Cancelada".
     *
     * @return bool
     */
    public function isCancelada(): bool
    {
        return $this === self::CANCELADA;
    }
}
