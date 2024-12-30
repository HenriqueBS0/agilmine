<?php

namespace App\View\Components\Sprint\Backlog;

use App\Models\Sprint;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use App\Services\ProjetoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TarefaMembros extends Component
{

    public $membros;

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint)
    {
        $this->membros = (new ProjetoService)->getMembros($sprint->projeto);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.backlog.tarefa-membros');
    }
}
