<?php

namespace App\Services\ApiRedmine\Operacoes\Listar;
use App\Services\ApiRedmine\Operacoes\QueryParamProvider;

/**
 * Classe responsável pela lógica de ordenação de resultados.
 *
 * Esta classe fornece métodos para definir a ordem dos resultados, tanto em ordem crescente quanto em ordem decrescente.
 */
class Ordenacao implements QueryParamProvider
{
    /**
     * Constante representando a ordem decrescente.
     */
    private const DECRESCENTE = 1;

    /**
     * Constante representando a ordem crescente.
     */
    private const CRESCENTE = 2;

    /**
     * Array armazenando os parâmetros de ordenação.
     *
     * @var array
     */
    private array $parametros = [];

    /**
     * Define uma ordem decrescente para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser ordenado em ordem decrescente.
     *
     * @return static Instância atualizada da classe Ordenacao.
     */
    public function decrescente(string $parametro): static
    {
        $this->parametros[$parametro] = self::DECRESCENTE;
        return $this;
    }

    /**
     * Define uma ordem crescente para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser ordenado em ordem crescente.
     *
     * @return static Instância atualizada da classe Ordenacao.
     */
    public function crescente(string $parametro): static
    {
        $this->parametros[$parametro] = self::CRESCENTE;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParametros(): array
    {
        if (count($this->parametros) == 0) {
            return [];
        }

        $sort = [];

        foreach ($this->parametros as $parametro => $modo) {
            $sort[] = $parametro . ($modo == self::DECRESCENTE ? ':desc' : '');
        }

        return [
            'sort' => implode(',', $sort)
        ];
    }
}
