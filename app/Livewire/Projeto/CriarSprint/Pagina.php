<?php

namespace App\Livewire\Projeto\CriarSprint;

use App\Livewire\Forms\SprintForm;
use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    public Projeto $projeto;

    public SprintForm $form;

    public $vercoes;

    public function mount(Projeto $projeto, ProjetoService $service)
    {
        $this->projeto = $projeto;
        $this->form->project_id = $projeto->id;
        $this->vercoes = $service->getVercoes($projeto);
    }

    public function render()
    {
        return view('livewire.projeto.criar-sprint.pagina');
    }

    public function save()
    {
        $this->authorize('isGestor', $this->projeto);

        $this->form->store();

        $this->alertaSucesso(__('messages.sprint_created_successfully', ['nome' => $this->form->nome]));

        $this->redirectRoute('pagina-projeto-sprints', ['projeto' => $this->projeto]);
    }
}
