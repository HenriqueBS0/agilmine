<?php

namespace App\Livewire\Projeto\Sprints;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use App\Models\Sprint;
use App\Services\ProjetoService;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Pagina extends Component
{
    use DisparadorAlerta;

    #[Locked]
    public Projeto $projeto;

    public array $tarefas;

    public array $vercoes;

    public $sprints;

    public function mount(Projeto $projeto, ProjetoService $service)
    {
        $this->projeto = $projeto;
        $this->sprints = $projeto->sprints;
        $this->tarefas = $service->getTarefas($projeto);
        $this->vercoes = $service->getVercoes($projeto);
    }

    public function render()
    {
        return view('livewire.projeto.sprints.pagina');
    }

    public function cancelar(Sprint $sprint)
    {
        $this->authorize('isGestor', $this->projeto);

        $sprint->cancelada = true;
        $sprint->save();

        $this->alertaSucesso(__('messages.sprint_cancelada', ['nome' => $sprint->nome]));

        $this->sprints = $this->projeto->sprints;
    }

    public function restaurar(Sprint $sprint)
    {
        $this->authorize('isGestor', $this->projeto);

        $sprint->cancelada = false;
        $sprint->save();

        $this->alertaSucesso(__('messages.sprint_restaurada', ['nome' => $sprint->nome]));

        $this->sprints = $this->projeto->sprints;
    }
}
