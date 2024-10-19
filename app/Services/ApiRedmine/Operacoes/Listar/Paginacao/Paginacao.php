<?php

namespace App\Services\ApiRedmine\Operacoes\Listar\Paginacao;

/**
 * Atributos comuns em controle de paginação de request e response em listagem de itens
 */
trait Paginacao
{
    /**
     * @var int
     */
    private int $desvio;

    /**
     * @var int
     */
    private int $limite;

    private function getDesvio(): int
    {
        return $this->desvio;
    }

    private function setDesvio(int $desvio): static
    {
        $this->desvio = $desvio;
        return $this;
    }

    private function getLimite(): int
    {
        return $this->limite;
    }

    private function setLimite(int $limite): static
    {
        $this->limite = $limite;
        return $this;
    }
}
