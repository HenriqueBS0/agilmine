<?php

namespace App\Livewire\Projeto\Kanban;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    public Projeto $projeto;

    public array $tarefas;

    public function mount(Projeto $projeto, ProjetoService $projetoService)
    {
        $this->projeto = $projeto;

        $this->tarefas = $projetoService->getTarefas($projeto);
    }

    public function render()
    {
        return view('livewire.projeto.kanban.pagina');
    }
}
