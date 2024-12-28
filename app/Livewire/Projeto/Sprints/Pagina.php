<?php

namespace App\Livewire\Projeto\Sprints;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    public Projeto $projeto;

    public array $tarefas;

    public array $vercoes;

    public $sprints;

    public function mount(Projeto $projeto, ProjetoService $service)
    {
        $this->projeto = $projeto;
        $this->sprints = $projeto->sprints()->get();
        $this->tarefas = $service->getTarefas($projeto);
        $this->vercoes = $service->getVercoes($projeto);
    }

    public function render()
    {
        return view('livewire.projeto.sprints.pagina');
    }
}
