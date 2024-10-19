<?php

namespace App\Services\ApiRedmine\Operacoes\Listar;
use App\Services\ApiRedmine\Operacoes\QueryParamProvider;

/**
 * Classe responsável pela lógica de filtragem de resultados.
 *
 * Esta classe fornece métodos para aplicar diferentes tipos de filtros aos dados,
 * incluindo iguais, em, entre, maior ou igual e menor ou igual.
 */
class Filtro implements QueryParamProvider
{
    private array $igual = [];
    private array $em = [];
    private array $entre = [];
    private array $maiorIgual = [];
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

    /**
     * {@inheritDoc}
     */
    public function getParametros(): array
    {
        $parametros = [];

        foreach ($this->igual as $parametro => $valor) {
            $parametros[$parametro] = $valor;
        }
        foreach ($this->em as $parametro => $valores) {
            $parametros[$parametro] = implode(',', $valores);
        }
        foreach ($this->entre as $parametro => $valores) {
            [$valorIncial, $valorFinal] = $valores;
            $parametros[$parametro] = "><{$valorIncial}|{$valorFinal}";
        }
        foreach ($this->maiorIgual as $parametro => $valor) {
            $parametros[$parametro] = ">={$valor}";
        }
        foreach ($this->menorIgual as $parametro => $valor) {
            $parametros[$parametro] = "<={$valor}";
        }

        return $parametros;
    }
}
