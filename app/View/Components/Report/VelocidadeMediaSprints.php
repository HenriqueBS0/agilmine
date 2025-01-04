<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasSprint;
use App\Services\SprintService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VelocidadeMediaSprints extends Component
{
    public array $labels = [];
    public array $datasets = [];

    /**
     * Create a new component instance.
     */
    public function __construct(public string $id, array $sprints, array $tarefas, SprintService $sprintService, MetricasSprint $metricasSprint)
    {
        $this->labels = $sprintService->mapIdentificacaoSprints($sprints);

        $velocidadeMedia = [];

        foreach ($sprints as $sprint) {
            $metricasSprint->setSprint($sprint)->setTarefas($tarefas);

            $velocidadeMedia[] = $metricasSprint->velocidadeMediaPorSemana();
        }

        $this->datasets[] = [
            'label' => 'Realizado',
            'data' => $velocidadeMedia,
            'fill' => false,
            'borderColor' => "css-var:--bs-destaque",
            'tension' => 0.1
        ];

        $this->options = [
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'font' => [
                            'size' => '16px',
                            'weight' => 'bold'
                        ]
                    ],
                ]
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.velocidade-media-sprints');
    }
}
