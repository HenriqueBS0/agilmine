<?php

namespace App\Livewire\Sprint\Backlog;

use App\Models\Sprint;
use App\Services\ProjetoService;
use App\Services\SprintService;
use Livewire\Component;

class Pagina extends Component
{
    public Sprint $sprint;

    public array $tarefasSprint;

    public array $tarefasProjeto;

    public function mount(Sprint $sprint, ProjetoService $projetoService, SprintService $sprintService)
    {
        $this->sprint = $sprint;

        $tarefas = $projetoService->getTarefas($sprint->projeto);

        $this->tarefasSprint = $sprintService->getTarefas($sprint, $tarefas);
        $this->tarefasProjeto = $sprintService->getTarefasSelecionar($sprint, $tarefas);
    }

    public function render()
    {
        return view('livewire.sprint.backlog.pagina');
    }

    public function atualizarTarefasSprint($tarefas)
    {
        $this->authorize('isGestor', $this->sprint->projeto);
        $this->sprint->tarefas = $tarefas;
        $this->sprint->save();
    }

    public function removerTarefa($tarefa)
    {
        $this->authorize('isGestor', $this->sprint->projeto);
        $this->sprint->tarefas = array_values(array_filter(
            $this->sprint->tarefas,
            function ($tarefaSprint) use ($tarefa) {
                return $tarefaSprint !== $tarefa;
            }
        ));
        $this->sprint->save();
    }
}
