<?php

namespace App\Services\ApiRedmine\Operacoes\Listar\Paginacao;

use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Paginacao;
use App\Services\ApiRedmine\Operacoes\QueryParamProvider;

/**
 * Parametro de paginação para listagens de itens
 */
final class Parametro implements QueryParamProvider
{
    use Paginacao;

    /**
     * Pagina atual que se deseja buscar
     * @var int
     */
    private int $pagina;

    /**
     * @param int $desvio O valor do desvio.
     * @param int $limite O valor do limite.
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
        if (!isset($this->pagina)) {
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

    /**
     * {@inheritDoc}
     */
    public function getParametros(): array
    {
        return [
            'offset' => $this->getDesvio(),
            'limit' => $this->getLimite()
        ];
    }
}
