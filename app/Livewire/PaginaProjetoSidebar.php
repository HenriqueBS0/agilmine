<?php

namespace App\Livewire;

use App\Services\ApiRedmine\Entidades\Projeto;
use Livewire\Component;

class PaginaProjetoSidebar extends Component
{

    public string $atual;

    public Projeto $projeto;

    public function mout(Projeto $projeto, string $atual)
    {
        $this->atual = $atual;
        $this->projeto = $projeto;
    }

    public function render()
    {
        return view('livewire.sidebar', [
            'itens' => [
                ['nome' => 'Sprints', 'href' => route('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()])]
            ]
        ]);
    }
}
