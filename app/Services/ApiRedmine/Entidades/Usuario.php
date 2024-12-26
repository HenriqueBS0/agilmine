<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Livewire\Wireable;
use Illuminate\Http\Client\Response;

class Usuario implements Wireable
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
     * Retorna objeto de parâmetros para busca de membros no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<Usuario[]>
     */
    public static function parametroListar(): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                return (new Usuario)
                    ->setId($dados['id'])
                    ->setNome($dados['firstname'] . ' ' . $dados['lastname']);

            }, [$response->json('user')]);
        };

        $parametro = new Parametros(
            (new Caminho('/my/account.json')),
            $fn,
            new Paginacao(0, 1)
        );

        return $parametro;
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
}
