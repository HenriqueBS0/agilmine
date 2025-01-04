<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Projetos extends Component
{
    public $valor;

    public $legenda = "Projetos";

    public $icone = "diagram-3";

    /**
     * Create a new component instance.
     */
    public function __construct(MetricasProjeto $metricasProjeto, array $projetos = null)
    {

        $this->valor = $metricasProjeto->numero($projetos);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
