<?php

namespace App\Livewire\Sprint\Eventos\Acessar;

use App\Livewire\Forms\SprintEventoForm;
use App\Models\Sprint;
use App\Models\SprintEvento;
use Livewire\Component;

class Pagina extends Component
{

    public Sprint $sprint;
    public SprintEventoForm $form;

    public function mount(Sprint $sprint, SprintEvento $evento)
    {
        $this->sprint = $sprint;
        $this->form->setEvento($evento);
    }
    public function render()
    {
        return view('livewire.sprint.eventos.acessar.pagina');
    }
}
