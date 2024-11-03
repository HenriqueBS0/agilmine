<?php

namespace App\Livewire;

use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Projeto;
use Livewire\Component;

class PaginaSprintSidebar extends Component
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
        return view('livewire.sidebar', [
            'itens' => [
                ['nome' => 'Report', 'href' => route('pagina-sprint-report', ['projetoId' => $this->projeto->getId(), 'sprint' => $this->sprint->id])],
                ['nome' => 'Backlog', 'href' => route('pagina-sprint-backlog', ['projetoId' => $this->projeto->getId(), 'sprint' => $this->sprint->id])],
                ['nome' => 'Detalhar', 'href' => route('pagina-sprint-detalhar', ['projetoId' => $this->projeto->getId(), 'sprint' => $this->sprint->id])],
            ]
        ]);
    }
}
