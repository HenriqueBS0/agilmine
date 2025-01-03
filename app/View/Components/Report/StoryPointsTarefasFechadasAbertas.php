<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasTarefas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StoryPointsTarefasFechadasAbertas extends Component
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

        $this->labels = ['Fechadas', 'Abertas'];

        $this->datasets = [
            [
                'label' => 'Story Points',
                'data' => [$metrica->storyPointsFechadas(), $metrica->storyPointsAbertas()],
                'backgroundColor' => [
                    'css-var:--bs-destaque',
                    'css-var:--bs-primary'
                ],
                'datalabels' => [
                    'color' => ['css-var:--bs-dark', 'css-var:--bs-light']
                ],
                'hoverOffset' => 4
            ],
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
        return view('components.report.story-points-tarefas-fechadas-abertas');
    }
}
