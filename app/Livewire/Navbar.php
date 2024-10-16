<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    /**
     *
     * @var \App\Livewire\Dto\NavbarBreadCrumbItem[]
     */
    public array $navbarBreadCrumbItens;

    public function mount($navbarBreadCrumbItens)
    {
        $this->navbarBreadCrumbItens = $navbarBreadCrumbItens;
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
