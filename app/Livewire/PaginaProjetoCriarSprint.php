<?php

namespace App\Livewire;

use App\Livewire\Traits\DisparadorAlerta;
use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use Livewire\Attributes\On;
use Livewire\Component;

class PaginaProjetoCriarSprint extends Component
{
    use ManipuladorProjeto;
    use DisparadorAlerta;

    public Sprint $sprint;

    public function mount(int $projetoId)
    {
        $this->setProjeto($projetoId);
        $this->setSprint();
    }

    private function setSprint()
    {
        $this->sprint = new Sprint([
            'project_id' => $this->projeto->getId()
        ]);
    }

    #[On('formulario-sprint-save')]
    public function onSave(int $sprint)
    {
        $sprintObject = Sprint::where('id', $sprint)->first();
        $this->alertaSucesso("Sprint {$sprintObject->serial} - {$sprintObject->nome} criada com sucesso");
        $this->redirectRoute('pagina-sprint-backlog', ['projetoId' => $this->projeto->getId(), 'sprint' => $sprint]);
    }

    #[On('formulario-sprint-cancelar')]
    public function onCancelar()
    {
        $this->redirectRoute('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()]);
    }

    public function render()
    {
        return view('livewire.pagina-projeto-criar-sprint');
    }
}
