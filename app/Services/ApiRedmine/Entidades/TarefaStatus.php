<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Illuminate\Http\Client\Response;
use Livewire\Wireable;

class TarefaStatus implements Wireable
{
    /**
     * Identificador do status
     * @var int
     */
    private ?int $id = null;

    /**
     * Nome do status
     * @var string
     */
    private ?string $nome = null;

    /**
     * Se a tarefa está fechada
     * @var
     */
    private bool $fechada = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setFechada(?bool $fechada): self
    {
        $this->fechada = $fechada === true;
        return $this;
    }


    public function getFechada(): bool
    {
        return $this->fechada;
    }


    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * @return {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'fechada' => $this->getFechada()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setNome($value['nome'])
            ->setFechada($value['fechada']);
    }

    /**
     * Retorna objeto de parâmetros para busca de Status de tarefa no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<TarefaStatus[]>
     */
    public static function parametroListar(int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                return (new TarefaStatus)
                    ->setId($dados['id'])
                    ->setNome($dados['name'])
                    ->setFechada($dados['is_closed']);
            }, $response->json('issue_statuses', []));
        };

        return new Parametros(
            new Caminho('/issue_statuses.json'),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );
    }
}
