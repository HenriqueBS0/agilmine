<?php

namespace App\View\Components\Report;

use App\Models\Projeto;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\DataTimeUtil;
use App\Services\Metricas\MetricasMembro;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MembrosCard extends Component
{
    public $numeroTarefas;

    public $numeroTarefasFechadas;

    public $horasEstimadas;

    public $horasGastas;

    public $storyPoints;

    public $storyPointsFechadas;


    /**
     * Create a new component instance.
     */
    public function __construct(
        public Projeto $projeto,
        public Membro $membro,
        array $tarefas,
        MetricasMembro $metrica,
        DataTimeUtil $dataTimeUtil
    ) {
        $metrica->setMembro($membro)->setTarefas($tarefas);

        $this->numeroTarefas = $metrica->tarefasDesenvolvedor()->numero();
        $this->numeroTarefasFechadas = $metrica->tarefasDesenvolvedor()->numeroFechadas();

        $this->horasEstimadas = $dataTimeUtil->horasFloatToString($metrica->tarefasDesenvolvedor()->horasEstimadas());
        $this->horasGastas = $dataTimeUtil->horasFloatToString($metrica->lancamentosHoras()->horasLancadas());

        $this->storyPoints = $metrica->tarefasDesenvolvedor()->storyPoints();
        $this->storyPointsFechadas = $metrica->tarefasDesenvolvedor()->storyPointsFechadas();
    }

    private function getTarefasMembro(Membro $membro, $tarefas)
    {
        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($membro) {
                return $tarefa->getDesenvolvedor()?->getId() === $membro->getUsuario()->getId();
            }
        ));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.membros-card');
    }
}
