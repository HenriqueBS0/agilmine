<?php

namespace App\Livewire;

use App\Models\Sprint;
use Livewire\Component;

class PaginaSprintModalExcluir extends Component
{
    public Sprint $sprint;

    public string $id;

    public function mount(Sprint $sprint, string $id)
    {
        $this->sprint = $sprint;
        $this->id = $id;
    }

    public function excluir()
    {
        $this->dispatch('sprint-delete', sprint: $this->sprint->id);
    }

    public function render()
    {
        return view('livewire.pagina-sprint-modal-excluir');
    }
}
