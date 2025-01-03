<?php

namespace App\View\Components\Sprint\Report;

use App\Models\Sprint;
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
        public Sprint $sprint,
        public Membro $membro,
        array $tarefas,
        MetricasMembro $metrica,
        DataTimeUtil $dataTimeUtil
    ) {
        $metrica->setMembro($membro)->setTarefas($tarefas);

        $this->numeroTarefas = $metrica->tarefas()->numero();
        $this->numeroTarefasFechadas = $metrica->tarefas()->numeroFechadas();

        $this->horasEstimadas = $dataTimeUtil->horasFloatToString($metrica->tarefas()->horasEstimadas());
        $this->horasGastas = $dataTimeUtil->horasFloatToString($metrica->tarefas()->horasGastas());

        $this->storyPoints = $metrica->tarefas()->storyPoints();
        $this->storyPointsFechadas = $metrica->tarefas()->storyPointsFechadas();
    }

    /**
     * 
     */
    private function getTarefasMembro(Membro $membro, $tarefas)
    {
        return array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($membro) {
                return $tarefa->getDesenvolvedor()->getId() === $membro->getUsuario()->getId();
            }
        );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.report.membros-card');
    }
}
