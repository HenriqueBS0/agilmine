<?php

namespace App\Livewire;

use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use Livewire\Component;

class PaginaProjetoSprints extends Component
{

    use ManipuladorProjeto;

    /**
     * @var \App\Models\Sprint[]
     */
    public array $sprints;

    public function mount(int $projetoId)
    {
        $this->setProjeto($projetoId);
        $this->setSprints();
    }

    private function setSprints()
    {
        $this->sprints = Sprint::where('project_id', $this->projeto->getId())->get()->all();
    }

    public function render()
    {
        return view('livewire.pagina-projeto-sprints');
    }
}
