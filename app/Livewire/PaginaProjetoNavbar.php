<?php

namespace App\Livewire;

use App\Services\ApiRedmine\Entidades\Projeto;
use Livewire\Component;

class PaginaProjetoNavbar extends Component
{
    public Projeto $projeto;

    public string $atual;

    public function moun(Projeto $projeto, string $atual)
    {
        $this->projeto = $projeto;
        $this->atual = $atual;
    }

    public function render()
    {
        return view('livewire.navbar', [
            'itens' => [
                ['nome' => 'Projetos', 'href' => route('pagina-projetos')],
                ['nome' => $this->projeto->getNome(), 'href' => route('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()])],
            ]
        ]);
    }
}
