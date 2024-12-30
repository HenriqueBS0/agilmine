<?php

namespace App\Livewire\Sprint\Detalhar;

use App\Livewire\Forms\SprintForm;
use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Sprint;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;
    public Sprint $sprint;

    public SprintForm $form;

    public $vercoes;

    public function mount(Sprint $sprint, ProjetoService $service)
    {
        $this->sprint = $sprint;
        $this->form->setSprint($sprint);
        $this->vercoes = $service->getVercoes($sprint->projeto);
    }

    public function save()
    {
        $this->authorize('isGestor', $this->sprint);

        $this->form->update();

        $this->alertaSucesso(__('messages.sprint_update_successfully', ['nome' => $this->form->nome]));
    }

    public function render()
    {
        return view('livewire.sprint.detalhar.pagina');
    }
}
