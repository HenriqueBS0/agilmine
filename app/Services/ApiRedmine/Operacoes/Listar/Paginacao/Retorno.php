<?php

namespace App\Services\ApiRedmine\Operacoes\Listar\Paginacao;

/**
 * Paginação do retorno de uma listagem de itens
 */
class Retorno
{
    use Paginacao;

    /**
     * Página atual
     * @var int
     */
    private int $pagina;

    /**
     * Número de páginas
     * @var int
     */
    private int $paginas;

    /**
     * Total de registros
     * @var int
     */
    private int $totalRegistros;

    /**
     * @param int $desvio O valor do desvio.
     * @param int $limite O valor do limite.
     * @param int $total O valor do total de registros
     */
    public function __construct(
        int $desvio,
        int $limite,
        int $totalRegistros
    ) {
        $this
            ->setDesvio($desvio)
            ->setLimite($limite)
            ->setTotalRegistros($totalRegistros);
    }

    /**
     * Obtém o total de registros.
     *
     * @return int O valor do total de registros.
     */
    private function getTotalRegistros(): int
    {
        return $this->totalRegistros;
    }

    /**
     * Define o total de registros.
     *
     * @param int $total O novo valor do total de registros.
     *
     * @return static A instância atualizada da classe Retorno.
     */
    private function setTotalRegistros(int $total): static
    {
        $this->totalRegistros = $total;
        return $this;
    }

    /**
     * Obtém a página atual.
     *
     * @return int O número da página atual.
     */
    public function pagina(): int
    {
        if (!isset($this->pagina)) {
            $this->pagina = $this->getDesvio() / $this->getLimite() + 1;
        }
        return $this->pagina;
    }

    /**
     * Obtém o número de páginas.
     *
     * @return int O número de páginas.
     */
    public function paginas(): int
    {
        if (!isset($this->paginas)) {
            $this->paginas = ceil($this->getTotalRegistros() / $this->getLimite());
        }
        return $this->paginas;
    }

    /**
     * Verifica se há próximas páginas.
     *
     * @return bool True se houver próximas páginas, false caso contrário.
     */
    public function hasProxima(): bool
    {
        return $this->pagina() < $this->paginas();
    }

    /**
     * Verifica se há páginas anteriores.
     *
     * @return bool True se houver páginas anteriores, false caso contrário.
     */
    public function hasAnterior(): bool
    {
        return $this->pagina() != 1;
    }
}
