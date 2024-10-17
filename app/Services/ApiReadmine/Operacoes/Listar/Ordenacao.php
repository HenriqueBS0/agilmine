<?php

namespace App\Services\ApiReadmine\Operacoes\Listar;

/**
 * Classe responsável pela lógica de ordenação de resultados.
 *
 * Esta classe fornece métodos para definir a ordem dos resultados, tanto em ordem crescente quanto em ordem decrescente.
 *
 * @package App\Services\ApiReadmine\Operacoes\Listar
 */
class Ordenacao
{
    /**
     * Constante representando a ordem decrescente.
     */
    final public const DECRESCENTE = 1;

    /**
     * Constante representando a ordem crescente.
     */
    final public const CRESCENTE = 2;

    /**
     * Array armazenando os parâmetros de ordenação.
     *
     * @var array
     */
    private array $parametros;

    /**
     * Construtor da classe Ordenacao.
     */
    public function __construct()
    {
        $this->parametros = [];
    }

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
     * Obtém os parâmetros de ordenação definidos.
     *
     * @return array Array contendo os parâmetros de ordenação.
     */
    public function getParametros(): array
    {
        return $this->parametros;
    }
}
