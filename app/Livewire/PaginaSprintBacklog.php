<?php

namespace App\Livewire;

use App\Livewire\Traits\DisparadorAlerta;
use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use Livewire\Component;

class PaginaSprintBacklog extends Component
{
    use ManipuladorProjeto, DisparadorAlerta;

    public array $tarefasSprint = [];
    public array $tarefasProjeto = [];
    public array $tarefaPrioridade = [];
    public array $tarefaTipo = [];
    public array $tarefaStatus = [];
    public array $membrosProjeto = [];
    public Sprint $sprint;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->setProjeto($sprint->project_id);
        $this->loadTarefasSprint();
        $this->loadTarefasProjeto();
        $this->loadTarefaPrioridade();
        $this->loadTarefaTipo();
        $this->loadTarefaStatus();
        $this->loadMembrosProjeto();
    }

    private function loadTarefasSprint(): void
    {
        $this->tarefasSprint = $this->filterTarefas(fn(Tarefa $tarefa) => in_array($tarefa->getId(), $this->sprint->tarefas));
    }

    private function loadTarefasProjeto(): void
    {
        $tarefasOutrasSprint = $this->getAllTarefasFromOtherSprints();

        $this->tarefasProjeto = $this->filterTarefas(
            fn(Tarefa $tarefa) => !$this->isTarefaInOtherSprint($tarefa, $tarefasOutrasSprint) && !$this->isTarefaConcluida($tarefa)
        );
    }

    private function filterTarefas(callable $callback): array
    {
        return array_values(array_filter($this->getAllTarefas(), $callback));
    }

    private function getAllTarefasFromOtherSprints(): array
    {
        return Sprint::where('project_id', $this->projeto->getId())
            ->get()
            ->pluck('tarefas')
            ->flatten()
            ->toArray();
    }

    private function getAllTarefas(): array
    {
        static $tarefas;

        if (!isset($tarefas)) {
            $tarefas = $this->fetchTarefas();
        }

        return $tarefas;
    }

    private function fetchTarefas(): array
    {
        $parametros = Tarefa::parametroListar(50);
        $parametros->filtro()->igual('project_id', $this->projeto->getId());
        $parametros->ordenacao()->crescente('id');

        $tarefas = [];
        $resposta = ApiRedmine::listar($parametros);

        do {
            $tarefas = array_merge($tarefas, $resposta->dados());
        } while ($resposta = $resposta->avancar());

        return $tarefas;
    }

    private function loadTarefaPrioridade(): void
    {
        $this->tarefaPrioridade = ApiRedmine::listar(TarefaPrioridade::parametroListar(30))->dados();
    }

    private function loadTarefaTipo(): void
    {
        $this->tarefaTipo = ApiRedmine::listar(TarefaTipo::parametroListar(30))->dados();
    }

    private function loadTarefaStatus(): void
    {
        $this->tarefaStatus = ApiRedmine::listar(TarefaStatus::parametroListar(30))->dados();
    }

    private function loadMembrosProjeto(): void
    {
        $this->membrosProjeto = ApiRedmine::listar(Membro::parametroListar($this->projeto->getId(), 30))->dados();
    }

    private function isTarefaInOtherSprint(Tarefa $tarefa, array $tarefasOutrasSprint): bool
    {
        return in_array($tarefa->getId(), $tarefasOutrasSprint);
    }

    private function isTarefaConcluida(Tarefa $tarefa): bool
    {
        return $tarefa->getStatus()->getFechada() && false;
    }

    public function adicionarTarefaSprint(int $tarefaId): void
    {
        $this->sprint->tarefas = array_merge($this->sprint->tarefas, [$tarefaId]);
        $this->sprint->save();
    }

    public function removerTarefaSprint(int $tarefaId): void
    {
        $this->sprint->tarefas = array_values(array_filter($this->sprint->tarefas, fn($id) => $id != $tarefaId));
        $this->sprint->save();
    }

    public function render()
    {
        return view('livewire.pagina-sprint-backlog');
    }
}
