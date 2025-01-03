<?php

namespace App\View\Components\Report;

use App\Models\Sprint;
use App\Services\DataTimeUtil;
use App\Services\Metricas\MetricasSprint;
use App\Services\SprintService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BurnDown extends Component
{
    public array $labels = [];

    public array $datasets = [];

    /**
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefas
     * @param \Illuminate\Support\Carbon $dataInicial
     * @param \Illuminate\Support\Carbon $dataFinal
     */
    public function __construct(
        public string $id,
        Sprint $sprint,
        array $tarefas = [],
        SprintService $service,
        MetricasSprint $metrica,
        DataTimeUtil $dataTimeUtil
    ) {
        $metrica
            ->setSprint($sprint)
            ->setTarefas($tarefas);

        $this->labels = $dataTimeUtil->diasMapString($service->dias($sprint));

        $this->datasets = [
            [
                'label' => 'Realizado',
                'data' => array_values($metrica->tarefasAbertasPorDiaRealizado()),
                'fill' => false,
                'borderColor' => "css-var:--bs-destaque",
                'tension' => 0.1
            ],
            [
                'label' => 'Estimado',
                'data' => array_values($metrica->tarefasAbertasPorDiaEstimado()),
                'fill' => false,
                'borderColor' => "css-var:--bs-primary",
                'tension' => 0.1
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.burn-down');
    }
}
