<?php

namespace App\Livewire\Report;

use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Tarefa;
use Livewire\Component;

class BurnUp extends Component
{
    public array $tarefasConcluidas = [];

    public function mount(Sprint $sprint, array $tarefas)
    {
        $dias = $sprint->getDias();
        $quantidadeTotalTarefas = count($tarefas);

        // Cálculo da quantidade estimada por dia (objetivo ideal)
        $quantidadeEstimadaPorDia = $quantidadeTotalTarefas / count($dias);

        foreach ($dias as $indiceDia => $dia) {
            // Verificar quantas tarefas foram concluídas até o dia atual
            $tarefasConcluidasAteAgora = array_filter($tarefas, function (Tarefa $tarefa) use ($dia) {
                return $tarefa->getStatus()->getFechada() && $tarefa->getDataConclusao() <= $dia;
            });

            $this->tarefasConcluidas[] = [
                'data' => $dia->format('d/m/Y'),
                'quantidade' => count($tarefasConcluidasAteAgora),
                'quantidadeEstimada' => max(0, round($quantidadeEstimadaPorDia * ($indiceDia + 1)))
            ];
        }
    }

    public function render()
    {
        return view('livewire.report.burn-up');
    }
}
