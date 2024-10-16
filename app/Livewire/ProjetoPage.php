<?php

namespace App\Livewire;

use App\Livewire\Dto\NavbarBreadCrumbItem;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use Livewire\Component;

class ProjetoPage extends Component
{
    /**
     * @var NavbarBreadCrumbItem[]
     */
    public $navbarBreadCrumbItens;

    public Projeto $projeto;

    public function mount(ApiReadmine $api, int $id)
    {
        $this->iniciaProjeto($api, $id);
        $this->iniciaNavbarBreadCrumbItens();
    }

    private function iniciaNavbarBreadCrumbItens()
    {
        $this->navbarBreadCrumbItens = [
            new NavbarBreadCrumbItem(false, 'Projetos', route('projetos-list')),
            new NavbarBreadCrumbItem(true, $this->projeto->getNome(), route('projetos-item', ['id' => $this->projeto->getId()])),
        ];
    }

    private function iniciaProjeto(ApiReadmine $api, int $id)
    {
        $this->projeto = $api->getFromId(Projeto::class, $id)->getData();
    }

    public function render()
    {
        return view('livewire.projeto-page');
    }
}
