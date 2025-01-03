<?php

namespace App\View\Components\Report;

use App\Services\Metricas\MetricasTarefas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TarefasRestantes extends Component
{
    public $valor;

    public $legenda = "Número de tarefas abertas";

    public $icone = "fire";

    /**
     * Create a new component instance.
     */
    public function __construct($tarefas, MetricasTarefas $metrica)
    {
        $this->valor = $metrica->setTarefas($tarefas)->numeroAbertas();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
