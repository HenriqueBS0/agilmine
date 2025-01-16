<?php

namespace App\Livewire\Projeto\Report;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    public Projeto $projeto;

    public array $tarefas;

    public array $membros;

    public function mount(Projeto $projeto, ProjetoService $service)
    {
        $this->projeto = $projeto;
        $this->tarefas = $service->getTarefas($projeto);
        $this->membros = $service->getMembros($projeto);
    }
    public function render()
    {
        return view('livewire.projeto.report.pagina');
    }
}