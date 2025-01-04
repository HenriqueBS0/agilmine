<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\Metricas\MetricasProjeto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReleasesProjetos extends Component
{
    public $valor;

    public $legenda = "Releases";

    public $icone = "cloud-upload";

    /**
     * Create a new component instance.
     */
    public function __construct(MetricasProjeto $metrica, array $projetos = [])
    {
        $this->valor = $metrica->releasesProjetos($projetos);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.indicador-icon');
    }
}
