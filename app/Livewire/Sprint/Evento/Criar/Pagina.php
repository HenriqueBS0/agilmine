<?php

namespace App\Livewire\Sprint\Evento\Criar;

use App\Models\Sprint;
use Livewire\Component;

class Pagina extends Component
{
    public Sprint $sprint;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
    }
    public function render()
    {
        return view('livewire.sprint.evento.criar.pagina');
    }
}
