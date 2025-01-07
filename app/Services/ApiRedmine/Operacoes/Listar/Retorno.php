<?php

namespace App\Services\ApiRedmine\Operacoes\Listar;

use App\Services\ApiRedmine\ApiRedmine;
use Illuminate\Http\Client\Response;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Retorno as Paginacao;

/**
 * Classe de controle da resposta de uma listagem de registros
 *
 * @template T tipo de dados a ser gerado pela listagem
 */
class Retorno
{
    /**
     * Parâmetros que geraram a resposta
     * @var Parametros
     */
    private Parametros $parametros;

    /**
     * Objeto de resposta gerado
     * @var Response
     */
    private Response $response;

    /**
     * Estrutura para controlar/consultar a paginação dos registros retornados
     * @var Paginacao
     */
    private Paginacao $paginacao;

    /**
     * Dados gerados pela consulta
     * @var mixed
     */
    private mixed $dados;

    public function __construct(Parametros $parametros, Response $response)
    {
        $this->setParametros($parametros);
        $this->setResponse($response);

        $totalCount = $response->json('total_count', 1);

        $this->setPaginacao(new Paginacao(
            $response->json('offset', 0),
            $response->json('limit', max(1, $totalCount)),
            $totalCount
        ));

        $this->setDados(call_user_func($parametros->getFuncaoTratarRetorno(), $response));
    }

    private function getParametros(): Parametros
    {
        return $this->parametros;
    }

    private function setParametros(Parametros $parametros): self
    {
        $this->parametros = $parametros;
        return $this;
    }

    private function getResponse(): Response
    {
        return $this->response;
    }

    private function setResponse(Response $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function paginacao(): Paginacao
    {
        return $this->paginacao;
    }

    private function setPaginacao(Paginacao $paginacao): self
    {
        $this->paginacao = $paginacao;

        return $this;
    }

    /**
     * Retorna os dados que a consulta gerou
     * @return T
     */
    public function dados(): mixed
    {
        return $this->dados;
    }

    private function setDados($dados): self
    {
        $this->dados = $dados;
        return $this;
    }

    /**
     * Pega os registros da próxima página
     *
     * @return Retorno|null
     */
    public function avancar(): Retorno|null
    {
        if (!$this->paginacao()->hasProxima()) {
            return null;
        }

        $this->getParametros()->paginacao()->setPagina($this->paginacao()->pagina() + 1);

        return ApiRedmine::listar($this->getParametros());
    }

    /**
     * Pega os registros da página anterior
     *
     * @return Retorno|null
     */

    public function voltar(): Retorno|null
    {
        if (!$this->paginacao()->hasAnterior()) {
            return null;
        }

        $this->getParametros()->paginacao()->setPagina($this->paginacao()->pagina() - 1);

        return ApiRedmine::listar($this->getParametros());
    }
}
