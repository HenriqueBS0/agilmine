<?php

namespace App\View\Components\Sprint\Report;

use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Tarefa;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tarefas extends Component
{

    public $tarefas;

    /**
     * @var Membro[]
     */
    private $membros = [];

    /**
     * Create a new component instance.
     */
    public function __construct($tarefas)
    {
        $this->tarefas = $tarefas;
    }

    public function linkTarefa(Tarefa $tarefa)
    {
        return \App\Models\Configuracao::getRedmineUrlApi(true) . '/issues/' . $tarefa->getId();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.report.tarefas');
    }
}
