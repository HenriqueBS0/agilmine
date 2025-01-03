<?php

namespace App\View\Components\Report;

use App\Models\Sprint;
use App\Services\Metricas\MetricasSprint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Velocidade extends Component
{
    public $valor;

    public $legenda = "Velocidade da equipe (Story Points Tarefas Fechadas)";

    public $icone = "speedometer2";

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint, array $tarefas, MetricasSprint $metrica)
    {
        $this->valor = $metrica->setSprint($sprint)->setTarefas($tarefas)->velocidade();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
