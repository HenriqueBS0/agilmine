<?php

namespace App\Livewire\Sprint\Kanban;

use App\Models\Sprint;
use App\Services\ProjetoService;
use App\Services\SprintService;
use Livewire\Component;

class Pagina extends Component
{

    public Sprint $sprint;

    public $tarefas;

    public function mount(Sprint $sprint, ProjetoService $projetoService, SprintService $sprintService)
    {
        $this->sprint = $sprint;
        $this->tarefas = $sprintService->getTarefas(
            $sprint,
            $projetoService->getTarefas($sprint->projeto)
        );
    }

    public function render()
    {
        return view('livewire.sprint.kanban.pagina');
    }
}
