<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Livewire\Wireable;
use Illuminate\Http\Client\Response;

class Membro implements Wireable
{
    /**
     * Id do membro
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Projeto em que o usuário é membro
     * @var Projeto|null
     */
    private ?Projeto $projeto = null;

    /**
     * Usuário que é membro do projeto
     * @var Usuario|null
     */
    private ?Usuario $usuario = null;

    /**
     * Perfis do usuário no projeto
     * @var PerfilProjeto[]
     */
    private array $perfis = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getProjeto(): ?Projeto
    {
        return $this->projeto;
    }

    public function setProjeto(?Projeto $projeto): self
    {
        $this->projeto = $projeto;
        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getPerfis(): array
    {
        return $this->perfis;
    }

    public function setPerfis(array $perfis): self
    {
        $this->perfis = $perfis;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toLivewire(): array
    {
        return [
            'id' => $this->getId(),
            'projeto' => $this->getProjeto(),
            'usuario' => $this->getUsuario(),
            'perfis' => $this->getPerfis(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value): self
    {
        return (new static)
            ->setId($value['id'] ?? null)
            ->setProjeto($value['projeto'] ?? null)
            ->setUsuario($value['usuario'] ?? null)
            ->setPerfis($value['perfis'] ?? []);
    }

    /**
     * Retorna objeto de parâmetros para busca de membros no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<Membro[]>
     */
    public static function parametroListar(int $projeto, int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                $membro = new Membro;

                $membro->setId($dados['id']);

                if (isset($dados['project']['id'])) {
                    $membro->setProjeto(
                        (new Projeto)
                            ->setId($dados['project']['id'])
                            ->setNome($dados['project']['name'])
                    );
                }

                if (isset($dados['user']['id'])) {
                    $membro->setUsuario(
                        (new Usuario)
                            ->setId($dados['user']['id'])
                            ->setNome($dados['user']['name'])
                    );
                }

                if (isset($dados['roles']) && is_array($dados['roles'])) {
                    $membro->setPerfis(
                        array_map(function ($perfil) {
                            return (new PerfilProjeto)
                                ->setId($perfil['id'])
                                ->setNome($perfil['name']);
                        }, $dados['roles'])
                    );
                }

                return $membro;

            }, $response->json('memberships', []));
        };

        $parametro = new Parametros(
            (new Caminho('/projects/{projeto}/memberships.json'))->addParametro('projeto', $projeto),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );

        return $parametro;
    }
}
