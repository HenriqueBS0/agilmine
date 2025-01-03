<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasTarefas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TarefasFechadasAbertas extends Component
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
                'label' => 'Quantidade',
                'data' => [$metrica->numeroFechadas(), $metrica->numeroAbertas()],
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
        return view('components.report.tarefas-fechadas-abertas');
    }
}
