<?php

namespace App\Livewire;

use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Projeto;
use Livewire\Component;

class PaginaSprintNavbar extends Component
{
    public Projeto $projeto;

    public Sprint $sprint;

    public string $atual;

    public function moun(Projeto $projeto, Sprint $sprint, string $atual)
    {
        $this->projeto = $projeto;
        $this->atual = $atual;
        $this->sprint = $sprint;
    }

    public function render()
    {
        return view('livewire.navbar', [
            'itens' => [
                ['nome' => 'Projetos', 'href' => route('pagina-projetos')],
                ['nome' => $this->projeto->getNome(), 'href' => route('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()])],
                ['nome' => 'Sprints', 'href' => route('pagina-projeto-sprints', ['projetoId' => $this->projeto->getId()])]
            ]
        ]);
    }
}
