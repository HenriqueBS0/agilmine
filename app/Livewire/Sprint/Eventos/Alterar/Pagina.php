<?php

namespace App\Livewire\Sprint\Eventos\Alterar;

use App\Livewire\Forms\SprintEventoForm;
use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Sprint;
use App\Models\SprintEvento;
use Livewire\Component;

class Pagina extends Component
{
    use DisparadorAlerta;

    public Sprint $sprint;
    public SprintEventoForm $form;

    public function mount(Sprint $sprint, SprintEvento $evento)
    {
        $this->sprint = $sprint;
        $this->form->setEvento($evento);
    }
    public function render()
    {
        return view('livewire.sprint.eventos.alterar.pagina');
    }

    public function save()
    {
        $this->authorize('isGestor', $this->form->evento->sprint);

        $this->form->update();

        $this->alertaSucesso(__('messages.sprint_event_update_successfully'));

        $this->redirectRoute('pagina-sprint-eventos', ['sprint' => $this->sprint]);
    }
}
