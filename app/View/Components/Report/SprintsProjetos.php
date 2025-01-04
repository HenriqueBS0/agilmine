<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SprintsProjetos extends Component
{
    public $valor;

    public $legenda = "Sprints";

    public $icone = "arrow-repeat";

    /**
     * Create a new component instance.
     */
    public function __construct(MetricasProjeto $metrica, array $projetos = [])
    {
        $this->valor = $metrica->sprintsProjetos($projetos);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
