<?php

namespace App\Livewire\Report;

use Livewire\Component;

class TempoEstimadoXGasto extends Component
{

    public float $estimado = 0;

    public float $gasto = 0;

    public function mount(array $tarefas)
    {
        /** @var \App\Services\ApiRedmine\Entidades\Tarefa $tarefa */
        foreach ($tarefas as $tarefa) {
            $this->estimado += $tarefa->getHorasEstimadas();
            $this->gasto += $tarefa->getHorasGastas() ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.report.tempo-estimado-x-gasto');
    }
}
