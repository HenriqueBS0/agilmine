<?php

namespace App\Livewire\Report;

use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Tarefa;
use Livewire\Component;

class BurnDown extends Component
{
    public array $tarefasNaoConcluidas = [];

    public function mount(Sprint $sprint, array $tarefas)
    {
        $dias = $sprint->getDias();
        $quantidadeTotalTarefas = count($tarefas);
        $quantidadeRestante = $quantidadeTotalTarefas;

        // Cálculo da quantidade estimada por dia (objetivo ideal)
        $quantidadeEstimadaPorDia = $quantidadeTotalTarefas / count($dias);

        foreach ($dias as $indiceDia => $dia) {
            // Verificar quantas tarefas foram concluídas até o dia atual
            $tarefasConcluidasAteAgora = array_filter($tarefas, function (Tarefa $tarefa) use ($dia) {
                return $tarefa->getStatus()->getFechada() && $tarefa->getDataConclusao() <= $dia;
            });

            $quantidadeRestante = $quantidadeTotalTarefas - count($tarefasConcluidasAteAgora);

            $this->tarefasNaoConcluidas[] = [
                'data' => $dia->format('d/m/Y'),
                'quantidade' => $quantidadeRestante,
                'quantidadeEstimada' => max(0, $quantidadeTotalTarefas - round($quantidadeEstimadaPorDia * ($indiceDia + 1)))
            ];
        }
    }

    public function render()
    {
        return view('livewire.report.burn-down');
    }
}
