<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Illuminate\Http\Client\Response;
use Livewire\Wireable;

class LancamentoHora implements Wireable
{
    /**
     * Identificador
     * @var int
     */
    private int $id;

    /**
     * Projeto
     * @var Projeto
     */
    private Projeto $projeto;

    /**
     * Tarefa em que foi lançada a hora
     * @var Tarefa
     */
    private Tarefa $tarefa;

    /**
     * Usuário que lançou as horas
     * @var Usuario
     */
    private Usuario $usuario;

    /**
     * Quantidades de horas
     * @var float
     */
    private float $horas = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getProjeto(): Projeto
    {
        return $this->projeto;
    }

    public function setProjeto(Projeto $projeto): self
    {
        $this->projeto = $projeto;
        return $this;
    }

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getTarefa(): Tarefa
    {
        return $this->tarefa;
    }

    public function setTarefa(Tarefa $Tarefa): self
    {
        $this->tarefa = $Tarefa;
        return $this;
    }

    public function getHoras(): float
    {
        return $this->horas;
    }

    public function setHoras(float $horas): self
    {
        $this->horas = $horas;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'projeto' => $this->getProjeto(),
            'usuario' => $this->getUsuario(),
            'tarefa' => $this->getTarefa(),
            'horas' => $this->getHoras()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setProjeto($value['projeto'])
            ->setUsuario($value['usuario'])
            ->setTarefa($value['tarefa'])
            ->setHoras($value['horas']);
    }

    /**
     * Retorna objeto de parâmetros para busca de Lançamentos de Horas no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<LancamentoHora[]>
     */
    public static function parametroListar(int $registrosPorPagina = 50): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                return (new LancamentoHora)
                    ->setId($dados['id'])
                    ->setHoras($dados['hours'])
                    ->setProjeto(
                        (new Projeto)
                            ->setId($dados['project']['id'])
                            ->setNome($dados['project']['name'])
                    )
                    ->setTarefa(
                        (new Tarefa())
                            ->setId($dados['issue']['id'])
                    )
                    ->setUsuario(
                        (new Usuario())
                            ->setId($dados['user']['id'])
                            ->setNome($dados['user']['name'])
                    );
            }, $response->json('time_entries', []));
        };

        return new Parametros(
            new Caminho('/time_entries.json'),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );
    }
}
