<?php

namespace App\Services\ApiReadmine\Operacoes\Listar\Paginacao;

use App\Services\ApiReadmine\Operacoes\Listar\Paginacao\Paginacao;

final class Parametro
{
    use Paginacao;

    /**
     * Pagina atual
     * @var int
     */
    private int $pagina;

    /**
     * @param int $desvio O valor inicial do desvio.
     * @param int $limite O valor inicial do limite.
     */
    public function __construct(
        int $desvio,
        int $limite
    ) {
        $this
            ->setDesvio($desvio)
            ->setLimite($limite);
    }

    /**
     * Obtém a página atual.
     *
     * @return int O número da página atual.
     */
    public function getPagina(): int
    {
        if (isset($this->pagina)) {
            $this->setPagina($this->getDesvio() * $this->getLimite() + 1);
        }

        return $this->pagina;
    }

    /**
     * Define a página atual.
     *
     * @param int $pagina O número da página para definir.
     *
     * @return static A instância atualizada da classe.
     */
    public function setPagina(int $pagina): static
    {
        $this->pagina = $pagina;
        $this->setDesvio(($pagina - 1) * $this->getLimite());
        return $this;
    }
}
