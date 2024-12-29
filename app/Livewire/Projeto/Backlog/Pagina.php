<?php

namespace App\Livewire\Projeto\Backlog;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    #[Locked]
    public Projeto $projeto;
    public array $tarefas;

    public function mount(Projeto $projeto, ProjetoService $projetoService)
    {
        $this->projeto = $projeto;
        $this->tarefas = $projetoService->getTarefas($projeto);
    }

    public function render()
    {
        return view('livewire.projeto.backlog.pagina');
    }

    public function atualizarBacklog($tarefas)
    {
        $this->authorize('isGestor', $this->projeto);
        $this->projeto->tarefas = $tarefas;
        $this->projeto->save();
    }
}
