<?php

namespace App\Livewire;

use App\Livewire\Forms\SprintForm;
use App\Models\Sprint;
use Livewire\Component;

class FormularioSprint extends Component
{
    public SprintForm $form;

    public bool $preencher = false;

    public bool $leitura = false;

    public string $save = 'store';

    public function mount(Sprint $sprint, string $save)
    {

        $this->save = $save;
        $this->form->setSprint($sprint, $this->preencher);
    }

    public function store()
    {
        $this->form->store();
        $this->dispatch('formulario-sprint-save', sprint: $this->form->sprint->id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('formulario-sprint-save', sprint: $this->form->sprint->id);
    }

    public function cancelar()
    {
        $this->dispatch('formulario-sprint-cancelar');
    }

    public function render()
    {
        return view('livewire.formulario-sprint');
    }
}
