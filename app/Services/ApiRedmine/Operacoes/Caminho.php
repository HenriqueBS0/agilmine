<?php

namespace App\Services\ApiRedmine\Operacoes;

/**
 * Esta classe é responsável por manipular e substituir parâmetros em um caminho.
 * Ela permite adicionar parâmetros dinâmicos ao caminho inicial e substituí-los posteriormente.
 *
 */
class Caminho
{
    /**
     * Armazena os parâmetros adicionados ao caminho.
     *
     * @var array<string, int|float|string>
     */
    private array $parametros = [];

    /**
     * Construtor da classe Caminho.
     *
     * @param string $caminho O caminho inicial que será usado como base para substituição de parâmetros.
     */
    public function __construct(
        private string $caminho
    ) {
    }

    /**
     * Adiciona um parâmetro ao caminho.
     *
     * @param string $nome O nome do parâmetro a ser adicionado.
     * @param int|float|string $valor O valor do parâmetro.
     *
     * @return static Instância atualizada da classe Caminho.
     */
    public function addParametro(string $nome, int|float|string $valor): static
    {
        $this->parametros[$nome] = $valor;
        return $this;
    }

    /**
     * Substitui os parâmetros no caminho inicial.
     *
     * @return string O caminho final com os parâmetros substituídos.
     */
    public function resolver(): string
    {
        $resultado = $this->caminho;
        foreach ($this->parametros as $nome => $valor) {
            $resultado = str_replace("{" . $nome . "}", (string) $valor, $resultado);
        }
        return ltrim($resultado, '/');
    }
}
