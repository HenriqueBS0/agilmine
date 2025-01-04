<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReleasesProjeto extends Component
{
    public $valor;

    public $legenda = "Releases";

    public $icone = "check-circle";

    /**
     * Create a new component instance.
     */
    public function __construct(Projeto $projeto, MetricasProjeto $metrica)
    {
        $this->valor = $metrica->setProjeto($projeto)->numeroReleases();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
