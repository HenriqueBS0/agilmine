<?php

namespace App\Livewire;

use App\Services\ApiReadmine\Entidades\Projeto;
use Livewire\Component;

class ProjetoItem extends Component
{
    public Projeto $projeto;

    public function render()
    {
        return view('livewire.projeto-item');
    }
}
