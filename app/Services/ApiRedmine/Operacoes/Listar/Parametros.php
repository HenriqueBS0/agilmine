<?php

namespace App\Services\ApiRedmine\Operacoes\Listar;
use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\QueryParamProvider;
use Illuminate\Http\Client\Response;

/**
 * Classe que concentra todos os parâmetros necessários para ser realizada uma listagem de registros
 *
 * @template T o valor de retorno que se espera da listagem
 */
class Parametros implements QueryParamProvider
{
    /**
     * Define onde o recurso está na api
     * @var Caminho
     */
    private Caminho $caminho;

    /**
     * Função responsável por pegar a resposta da api e transformar no tipo T esperado
     * @var mixed
     */
    private mixed $funcaoTratarRetorno;

    /**
     * Define como a paginação será aplicada na consulta
     * @var Paginacao
     */
    private Paginacao $paginacao;

    /**
     * Define como os registros serão ordenados
     * @var Ordenacao
     */
    private Ordenacao $ordenacao;

    /**
     * Define como os registros serão filtrados
     * @var Filtro
     */
    private Filtro $filtro;

    /**
     * @param \App\Services\ApiRedmine\Operacoes\Caminho $caminho
     * @param \App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro $paginacao
     * @param \App\Services\ApiRedmine\Operacoes\Listar\Ordenacao $ordenacao
     * @param \App\Services\ApiRedmine\Operacoes\Listar\Filtro $filtro
     * @param callable(Response):T $tratarRetorno
     */
    public function __construct(
        Caminho $caminho,
        mixed $tratarRetorno,
        Paginacao|null $paginacao = new Paginacao(0, 25)
    ) {
        $this->setCaminho($caminho);
        $this->setFuncaoTratarRetorno($tratarRetorno);
        $this->setPaginacao($paginacao);
        $this->setOrdenacao(new Ordenacao);
        $this->setFiltro(new Filtro);
    }

    private function setFuncaoTratarRetorno(mixed $fn): static
    {
        $this->funcaoTratarRetorno = $fn;
        return $this;
    }

    public function getFuncaoTratarRetorno(): mixed
    {
        return $this->funcaoTratarRetorno;
    }

    private function setCaminho(Caminho $caminho): static
    {
        $this->caminho = $caminho;
        return $this;
    }

    public function caminho(): Caminho
    {
        return $this->caminho;
    }

    private function setPaginacao(Paginacao $paginacao): static
    {
        $this->paginacao = $paginacao;
        return $this;
    }

    public function paginacao(): Paginacao
    {
        return $this->paginacao;
    }

    private function setOrdenacao(Ordenacao $ordenacao): static
    {
        $this->ordenacao = $ordenacao;
        return $this;
    }

    public function ordenacao(): Ordenacao
    {
        return $this->ordenacao;
    }

    private function setFiltro(Filtro $filtro): static
    {
        $this->filtro = $filtro;
        return $this;
    }
    public function filtro(): Filtro
    {
        return $this->filtro;
    }

    /**
     * {@inheritDoc}
     */
    public function getParametros(): array
    {
        return array_merge(
            $this->paginacao()->getParametros(),
            $this->ordenacao()->getParametros(),
            $this->filtro()->getParametros(),
        );
    }
}
