<?php

namespace App\Livewire\Projeto\Report;

use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Projeto;
use Livewire\Component;

class Pagina extends Component
{

    public Projeto $projeto;

    public function mount(Projeto $projeto)
    {
        $this->projeto = $projeto;
    }
    public function render()
    {
        return view('livewire.projeto.report.pagina');
    }
}