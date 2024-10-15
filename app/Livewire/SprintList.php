<?php

namespace App\Livewire;

use App\Models\Sprint;
use App\Services\ApiReadmine\Entidades\Projeto;
use Livewire\Component;

class SprintList extends Component
{

    public array $sprints;
    public Projeto $projeto;
    public function mount(Projeto $projeto)
    {
        $this->projeto = $projeto;
        $this->definirSprints();
    }

    private function definirSprints()
    {
        $this->sprints = [];
        foreach (Sprint::where('project_id', $this->projeto->getId())->get() as $sprint) {
            $this->sprints[] = $sprint;
        }
    }

    public function criar()
    {
        $this->redirectRoute('criar-sprint', ['id' => $this->projeto->getId()]);
    }

    public function alterar(int $sprint)
    {
        $this->redirectRoute('alterar-sprint', [
            'id' => $this->projeto->getId(),
            'sprint' => $sprint
        ]);
    }

    public function excluir(Sprint $sprint)
    {
        $sprint->delete();
        $this->definirSprints();
    }

    public function acessar(Sprint $sprint)
    {
        $this->redirectRoute('datalhar-sprint', [
            'id' => $this->projeto->getId(),
            'sprint' => $sprint->id
        ]);
    }

    public function render()
    {
        return view('livewire.sprint-list');
    }
}
