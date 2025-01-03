<?php

namespace App\View\Components\Report;

use App\Services\DataTimeUtil;
use App\Services\Metricas\MetricasTarefas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TempoEstimadoRestante extends Component
{
    public $valor;

    public $legenda = "Tempo Estimado Restante = (Tempo estimado - Tempo Gasto) Tarefas Abertas";

    public $icone = "clock";

    /**
     * Create a new component instance.
     */
    public function __construct(array $tarefas, MetricasTarefas $metrica, DataTimeUtil $dataTimeUtil)
    {
        $this->valor = $dataTimeUtil->horasFloatToString($metrica->setTarefas($tarefas)->horasEstimadaAbertasRestantes());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
