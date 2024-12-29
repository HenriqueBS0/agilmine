<?php

namespace App\View\Components\Projeto\Sprints;

use App\Models\Enums\SprintStatus;
use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Versao;
use App\Services\ColorMixer;
use App\Services\SprintService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public Sprint $sprint;

    public array $tarefas;

    public ?Versao $versao;

    public SprintStatus $status;

    public float $proporcaoFeita;

    public string $tipo;

    public int $totalTarefas;

    public int $totalTarefasFechadas;

    public string $corTexto;

    public string $corFundo;

    public string $corBorda;

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint, $tarefas, $vercoes, SprintService $service, ColorMixer $colorMixer)
    {
        $this->sprint = $sprint;
        $this->tarefas = $service->getTarefas($sprint, $tarefas);
        $this->versao = $service->getVersao($sprint, $vercoes);
        $this->status = $service->getStatus($this->sprint, $this->tarefas);
        $this->proporcaoFeita = $service->getProporcaoFeita($this->sprint, $this->tarefas);
        $this->tipo = $sprint->gera_release ? 'Release' : 'Sprint';
        $this->totalTarefas = count($this->tarefas);
        $this->totalTarefasFechadas = count($service->getTarefasFechadas($this->sprint, $this->tarefas));

        $cor = $service->getCor($sprint, $this->tarefas);

        $this->corTexto = $colorMixer->corTexto($cor);
        $this->corFundo = $colorMixer->corFundo($cor);
        $this->corBorda = $colorMixer->corBorda($cor);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projeto.sprints.card');
    }
}
