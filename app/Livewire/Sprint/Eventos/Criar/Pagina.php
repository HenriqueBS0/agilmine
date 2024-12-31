<?php

namespace App\Livewire\Sprint\Eventos\Criar;


use App\Livewire\Forms\SprintEventoForm;
use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Sprint;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Pagina extends Component
{
    use DisparadorAlerta;

    #[Locked]
    public Sprint $sprint;
    public SprintEventoForm $form;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->form->sprint_id = $sprint->id;
    }
    public function render()
    {
        return view('livewire.sprint.eventos.criar.pagina');
    }

    public function save()
    {

        $this->authorize('isGestor', $this->sprint);

        $this->form->store();

        $this->alertaSucesso(__('messages.sprint_event_created_successfully'));

        $this->redirectRoute('pagina-sprint-eventos', ['sprint' => $this->sprint]);
    }
}
