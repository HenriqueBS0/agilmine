<?php

namespace App\Livewire;

use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use Livewire\Component;

class PaginaSprintBacklogDetalhamentoTarefa extends Component
{

    public ?int $identificador = null;

    public ?string $titulo = null;

    public ?int $prioridade = null;

    public ?array $prioridades = null;

    public ?int $storyPoints = null;

    public ?int $tipo = null;

    public ?array $tipos = null;

    public ?int $status = null;

    public ?array $statusList = null;

    public ?float $proporcaoFeita = null;

    public ?string $horasEstimadas = null;

    public ?string $horasGastas = null;

    public ?string $dataCriacao = null;

    public ?string $dataUltimaAlteracao = null;

    public ?string $dataPrevista = null;

    public ?string $dataInicio = null;

    public ?string $dataConclusao = null;

    public ?int $autor = null;

    public ?int $desenvolvedor = null;

    public ?int $descritor = null;

    public ?int $testador = null;

    public ?array $membros = null;

    public ?string $descricao = null;

    public function mount(array $prioridades, array $tipos, array $statusList, array $membros)
    {
        $this->setPrioridades($prioridades);
        $this->setTipos($tipos);
        $this->setStatusList($statusList);
        $this->setMembros($membros);
    }

    /**
     * @param \App\Services\ApiRedmine\Entidades\TarefaPrioridade[] $prioridades
     */
    private function setPrioridades(array $prioridades): void
    {
        $this->prioridades = array_map(
            fn(TarefaPrioridade $prioridade) => ['valor' => $prioridade->getId(), 'descricao' => $prioridade->getNome()],
            $prioridades
        );
    }

    /**
     * @param \App\Services\ApiRedmine\Entidades\TarefaTipo[] $tipos
     */
    private function setTipos(array $tipos): void
    {
        $this->tipos = array_map(
            fn(TarefaTipo $tipo) => ['valor' => $tipo->getId(), 'descricao' => $tipo->getNome()],
            $tipos
        );
    }

    /**
     * @param \App\Services\ApiRedmine\Entidades\TarefaStatus[] $status
     */
    private function setStatusList(array $status): void
    {
        $this->statusList = array_map(
            fn(TarefaStatus $status) => ['valor' => $status->getId(), 'descricao' => $status->getNome()],
            $status
        );
    }

    /**
     * @param \App\Services\ApiRedmine\Entidades\Membro[] $membros
     */
    private function setMembros(array $membros): void
    {
        $fnMap = function (Membro $membro) {
            return [
                'valor' => $membro->getUsuario()->getId(),
                'descricao' => $membro->getUsuario()->getNome()
            ];
        };

        $this->membros = array_map($fnMap, $membros);
    }

    public function setTarefa(int $tarefaId)
    {
        if ($tarefaId === $this->identificador) {
            return;
        }

        $tarefa = $this->fetchTarefa($tarefaId);

        $this->identificador = $tarefa->getId();
        $this->titulo = $tarefa->getTitulo();
        $this->prioridade = $tarefa->getPrioridade()->getId();
        $this->storyPoints = $tarefa->getPontosHistoria();
        $this->tipo = $tarefa->getTipo()->getId();
        $this->status = $tarefa->getStatus()->getId();
        $this->proporcaoFeita = $tarefa->getProporcaoFeita();
        $this->horasEstimadas = $tarefa->getStringHorasEstimadas();
        $this->horasGastas = $tarefa->getStringHorasGastas();
        $this->dataCriacao = $tarefa->getDataCriacao()?->format('Y-m-d');
        $this->dataUltimaAlteracao = $tarefa->getDataAtualizacao()?->format('Y-m-d');
        $this->dataPrevista = $tarefa->getDataConclusaoEstimada()?->format('Y-m-d');
        $this->dataInicio = $tarefa->getDataInicio()?->format('Y-m-d');
        $this->dataConclusao = $tarefa->getDataConclusao()?->format('Y-m-d');
        $this->autor = $tarefa->getAutor()?->getId();
        $this->desenvolvedor = $tarefa->getDesenvolvedor()?->getId();
        $this->descritor = $tarefa->getDescritor()?->getId();
        $this->testador = $tarefa->getDescritor()?->getId();
        $this->descricao = $tarefa->getDescricao();
    }

    /**
     * @param int $tarefaId
     * @return Tarefa
     */
    private function fetchTarefa(int $tarefaId)
    {
        $parametros = Tarefa::parametroListar(1);
        $parametros->filtro()->igual('issue_id', $tarefaId);
        return ApiRedmine::listar($parametros)->dados()[0];
    }

    public function render()
    {
        return view('livewire.pagina-sprint-backlog-detalhamento-tarefa');
    }
}
