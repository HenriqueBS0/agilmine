<?php

namespace App\View\Components;

use App\Services\ApiRedmine\Entidades\Tarefa;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Kanban extends Component
{

    /**
     * Create a new component instance.
     * 
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefa
     */
    public function __construct(public array $tarefas)
    {
    }

    /**
     * @param Tarefa[] $tarefas
     * @param int $situacao
     * @return Tarefa[]
     */
    private function filterFromSituacao($tarefas, $situacao)
    {
        $tarefasFiltradas = [];

        foreach ($tarefas as $tarefa) {
            if ($tarefa->getStatus()->getId() == $situacao) {
                $tarefasFiltradas[] = $tarefa;
            }
        }

        return $tarefasFiltradas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kanban', [
            'aberta' => $this->filterFromSituacao($this->tarefas, 1),
            'desenvolvimento' => $this->filterFromSituacao($this->tarefas, 2),
            'fechada' => $this->filterFromSituacao($this->tarefas, 3),
            'cancelada' => $this->filterFromSituacao($this->tarefas, 4),
            'aprovacao' => $this->filterFromSituacao($this->tarefas, 5),
        ]);
    }
}
