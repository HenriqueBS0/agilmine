<?php

namespace App\Livewire;

use App\Livewire\Traits\DisparadorAlerta;
use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use Livewire\Attributes\On;
use Livewire\Component;

class PaginaSprintAlterar extends Component
{

    use ManipuladorProjeto;
    use DisparadorAlerta;

    public Sprint $sprint;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->setProjeto($sprint->project_id);
        $this->alertaAtencao('Você está alterando a sprint', true);
    }

    #[On('formulario-sprint-save')]
    public function onUpdate(int $sprint)
    {
        $sprintObject = Sprint::where('id', $sprint)->first();
        $this->alertaSucesso("Sprint {$sprintObject->serial} - {$sprintObject->nome} alterada com sucesso!");
        $this->redirectRoute('pagina-sprint-detalhar', ['projetoId' => $this->projeto->getId(), 'sprint' => $sprint]);
    }

    #[On('formulario-sprint-cancelar')]
    public function onCancelar()
    {
        $this->redirectRoute('pagina-sprint-detalhar', ['projetoId' => $this->projeto->getId(), 'sprint' => $this->sprint->id]);
    }

    public function render()
    {
        return view('livewire.pagina-sprint-alterar');
    }
}
