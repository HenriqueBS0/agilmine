<?php

namespace App\Livewire;

use App\Livewire\Traits\DisparadorAlerta;
use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use Livewire\Attributes\On;
use Livewire\Component;

class PaginaSprintDetalhar extends Component
{

    use ManipuladorProjeto;
    use DisparadorAlerta;

    public Sprint $sprint;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->setProjeto($sprint->project_id);
    }

    #[On('sprint-delete')]
    public function onDelete(Sprint $sprint)
    {
        $this->alertaSucesso("Sprint {$sprint->serial} - {$sprint->nome} excluída com sucesso!");
        $sprint->delete();
        $this->redirectRoute('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()]);
    }

    public function render()
    {
        return view('livewire.pagina-sprint-detalhar');
    }
}
