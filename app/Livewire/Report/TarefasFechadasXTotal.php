<?php

namespace App\Livewire\Report;

use Livewire\Component;

class TarefasFechadasXTotal extends Component
{

    public int $fechadas = 0;

    public int $naoFechadas = 0;

    public function mount(array $tarefas)
    {
        /** @var \App\Services\ApiRedmine\Entidades\Tarefa $tarefa */
        foreach ($tarefas as $tarefa) {
            if ($tarefa->getStatus()->getFechada()) {
                $this->fechadas++;
            } else {
                $this->naoFechadas++;
            }
        }
    }

    public function render()
    {
        return view('livewire.report.tarefas-fechadas-x-total');
    }
}
