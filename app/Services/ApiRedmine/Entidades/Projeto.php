<?php

namespace App\Services\ApiRedmine\Entidades;
use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Livewire\Wireable;
use Illuminate\Http\Client\Response;

class Projeto implements Wireable
{
    /**
     * Id do projeto
     * @var int
     */
    private ?int $id = null;

    /**
     * Nome do projeto
     * @var string
     */
    private ?string $nome = null;

    /**
     * Descrição do projeto
     * @var string
     */
    private ?string $descricao = null;

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Retorna objeto de parâmetros para busca de projetos no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<Projeto[]>
     */
    public static function parametroListar(int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                $projeto = new Projeto;
                $projeto->setId($dados['id']);
                $projeto->setNome($dados['name']);
                $projeto->setDescricao($dados['description'] ?? null);
                return $projeto;
            }, $response->json('projects', []));
        };

        return new Parametros(
            new Caminho('/projects.json'),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );
    }

    /**
     * Retorna objeto de parâmetros para busca de projetos no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<Projeto>
     */
    public static function parametroFind(int $id): Parametros
    {
        $fn = function (Response $response) {
            $dados = $response->json('project');

            return (new Projeto())
                ->setId($dados['id'])
                ->setNome($dados['name'])
                ->setDescricao($dados['description'] ?? null);
        };

        return new Parametros(
            new Caminho("/projects/{$id}.json"),
            $fn,
            new Paginacao(0, 1)
        );
    }

    /**
     * @return {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'descricao' => $this->getDescricao()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value)
    {
        return (new static)
            ->setId($value['id'])
            ->setNome($value['nome'])
            ->setDescricao($value['descricao']);
    }
}
