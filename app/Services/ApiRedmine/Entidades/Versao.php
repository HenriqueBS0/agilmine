<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Illuminate\Http\Client\Response;
use Livewire\Wireable;

class Versao implements Wireable
{
    /**
     * Identificador
     * @var int
     */
    private ?int $id = null;

    /**
     * Nome
     * @var string
     */
    private ?string $nome = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
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
     * {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setNome($value['nome']);
    }

    /**
     * Retorna objeto de parâmetros para busca de Tipos de tarefa no redmine
     *
     * @param
     * @param int $registrosPorPagina
     * @return Parametros<Versao[]>
     */
    public static function parametroListar(int $projetoId, int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                return (new Versao)
                    ->setId($dados['id'])
                    ->setNome($dados['name']);
            }, $response->json('versions', []));
        };

        return new Parametros(
            (new Caminho('/projects/{projeto}/versions.json'))->addParametro('projeto', $projetoId),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );
    }
}
