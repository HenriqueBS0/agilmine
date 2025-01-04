<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasSprint;
use App\Services\Metricas\MetricasTarefas;
use App\Services\SprintService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TempoEstimadoTempoGasto extends Component
{
    public array $labels = [];

    public array $datasets = [];

    public array $options = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        array $tarefas,
        array $sprints,
        SprintService $sprintService,
        MetricasSprint $metrica
    ) {
        $this->labels = $sprintService->mapIdentificacaoSprints($sprints);

        $dataEstimado = [];

        $dataGasto = [];

        foreach ($sprints as $sprint) {
            $metrica->setSprint($sprint)->setTarefas($tarefas);
            $dataEstimado[] = $metrica->tarefas()->horasEstimadas();
            $dataGasto[] = $metrica->tarefas()->horasGastas();
        }

        $this->datasets[] = [
            'label' => 'Estimado',
            'data' => $dataEstimado,
            'backgroundColor' => [
                'css-var:--bs-primary-bg-subtle'
            ],
            'borderColor' => [
                'css-var:--bs-primary'
            ],
            'datalabels' => [
                'color' => 'css-var:--bs-primary-text-emphasis'
            ],
            'borderWidth' => 1
        ];

        $this->datasets[] = [
            'label' => 'Gasto',
            'data' => $dataGasto,
            'backgroundColor' => [
                'css-var:--bs-destaque-bg-subtle'
            ],
            'borderColor' => [
                'css-var:--bs-destaque'
            ],
            'datalabels' => [
                'color' => 'css-var:--bs-destaque-text-emphasis'
            ],
            'borderWidth' => 1
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
        return view('components.report.tempo-estimado-tempo-gasto');
    }
}
