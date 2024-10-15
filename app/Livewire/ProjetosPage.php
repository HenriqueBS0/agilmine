<?php

namespace App\Livewire;

use App\Livewire\Dto\NavbarBreadCrumbItem;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use Livewire\Component;

class ProjetosPage extends Component
{

    /**
     * @var NavbarBreadCrumbItem[]
     */
    public $navbarBreadCrumbItens;

    /**
     * @var Projeto[]
     */
    public array $projetos;

    public function mount(ApiReadmine $apiReadmine)
    {
        $this->projetos = $apiReadmine->getAll(Projeto::class)->getData();
        $this->navbarBreadCrumbItens = [new NavbarBreadCrumbItem(true, 'Projetos', route('projetos-list'))];
    }

    public function render()
    {
        return view('livewire.projetos-page');
    }
}
