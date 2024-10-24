<?php

namespace App\Livewire;

use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Projeto;
use Livewire\Component;

class PaginaProjetos extends Component
{

    public array $projetos;

    public function mount()
    {
        $this->setProjetos();
    }

    private function setProjetos()
    {
        $this->projetos = ApiRedmine::listar(Projeto::parametroListar(100))->dados();
        ds($this->projetos);
    }

    public function render()
    {
        return view('livewire.pagina-projetos');
    }
}
