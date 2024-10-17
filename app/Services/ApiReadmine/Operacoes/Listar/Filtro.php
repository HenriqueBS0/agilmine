<?php

namespace App\Services\ApiReadmine\Operacoes\Listar;

/**
 * Classe responsável pela lógica de filtragem de resultados.
 *
 * Esta classe fornece métodos para aplicar diferentes tipos de filtros aos dados,
 * incluindo iguais, em, contém, entre, maior, maior ou igual, menor e menor ou igual.
 *
 * @package App\Services\ApiReadmine\Operacoes\Listar
 */
class Filtro
{
    private array $igual = [];
    private array $em = [];
    private array $contem = [];
    private array $entre = [];
    private array $maior = [];
    private array $maiorIgual = [];
    private array $menor = [];
    private array $menorIgual = [];

    /**
     * Aplica um filtro de igualdade para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valor Valor para o filtro de igualdade.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function igual(string $parametro, string|int|float $valor): static
    {
        $this->igual[$parametro] = $valor;
        return $this;
    }

    /**
     * Aplica um filtro em para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param array<string|int|float> $valores Array de valores para o filtro em.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function em(string $parametro, array $valores): static
    {
        $this->em[$parametro] = $valores;
        return $this;
    }

    /**
     * Aplica um filtro de contém para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string $valor Valor para o filtro de contém.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function contem(string $parametro, string $valor): static
    {
        $this->contem[$parametro] = $valor;
        return $this;
    }

    /**
     * Aplica um filtro entre para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valorInicial Valor inicial do intervalo.
     * @param string|int|float $valorFinal Valor final do intervalo.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function entre(string $parametro, string|int|float $valorInicial, string|int|float $valorFinal): static
    {
        $this->entre[$parametro] = [$valorInicial, $valorFinal];
        return $this;
    }

    /**
     * Aplica um filtro maior que para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valor Valor para o filtro maior que.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function maior(string $parametro, string|int|float $valor): static
    {
        $this->maior[$parametro] = $valor;
        return $this;
    }

    /**
     * Aplica um filtro maior ou igual para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valor Valor para o filtro maior ou igual.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function maiorIgual(string $parametro, string|int|float $valor): static
    {
        $this->maiorIgual[$parametro] = $valor;
        return $this;
    }

    /**
     * Aplica um filtro menor que para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valor Valor para o filtro menor que.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function menor(string $parametro, string|int|float $valor): static
    {
        $this->menor[$parametro] = $valor;
        return $this;
    }

    /**
     * Aplica um filtro menor ou igual para um parâmetro específico.
     *
     * @param string $parametro Nome do parâmetro a ser filtrado.
     * @param string|int|float $valor Valor para o filtro menor ou igual.
     *
     * @return static Instância atualizada da classe Filtro.
     */
    public function menorIgual(string $parametro, string|int|float $valor): static
    {
        $this->menorIgual[$parametro] = $valor;
        return $this;
    }
}
