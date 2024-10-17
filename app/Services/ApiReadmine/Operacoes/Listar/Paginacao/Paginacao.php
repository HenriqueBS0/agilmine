<?php

namespace App\Services\ApiReadmine\Operacoes\Listar\Paginacao;

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

    /**
     * Obtém o desvio.
     *
     * @return int O valor do desvio.
     */
    private function getDesvio(): int
    {
        return $this->desvio;
    }

    /**
     * Define o desvio.
     *
     * @param int $desvio O novo valor do desvio.
     *
     * @return static A instância atualizada da trait.
     */
    private function setDesvio(int $desvio): static
    {
        $this->desvio = $desvio;
        return $this;
    }

    /**
     * Obtém o limite.
     *
     * @return int O valor do limite.
     */
    private function getLimite(): int
    {
        return $this->limite;
    }

    /**
     * Define o limite.
     *
     * @param int $limite O novo valor do limite.
     *
     * @return static A instância atualizada da trait.
     */
    private function setLimite(int $limite): static
    {
        $this->limite = $limite;
        return $this;
    }
}
