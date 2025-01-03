<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasTarefas;
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
        MetricasTarefas $metrica
    ) {
        $metrica->setTarefas($tarefas);

        $this->labels = ['Horas'];

        $this->datasets = [
            [
                'label' => 'Estimado',
                'data' => [$metrica->horasEstimadas()],
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
            ],
            [
                'label' => 'Gasto',
                'data' => [$metrica->horasGastas()],
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
            ]
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
