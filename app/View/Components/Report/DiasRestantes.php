<?php

namespace App\View\Components\Report;

use App\Models\Sprint;
use App\Services\Metricas\MetricasSprint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DiasRestantes extends Component
{
    public $valor;

    public $legenda = "Dias para terminar a sprint";

    public $icone = "calendar";

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint, MetricasSprint $metrica)
    {
        $this->valor = $metrica->setSprint($sprint)->numeroDiasRestantes();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
