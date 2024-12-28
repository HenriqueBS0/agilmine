<?php

namespace App\Livewire\Projeto\Membros;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    public Projeto $projeto;

    public array $membros;

    public function mount(Projeto $projeto, ProjetoService $service)
    {
        $this->projeto = $projeto;
        $this->membros = $service->getMembros($projeto);

        ds($this->membros);
    }

    public function render()
    {
        return view('livewire.projeto.membros.pagina');
    }
}
