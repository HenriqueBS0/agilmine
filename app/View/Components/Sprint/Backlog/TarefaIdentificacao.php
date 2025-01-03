<?php

namespace App\View\Components\Sprint\Backlog;

use App\Contracts\FetchRedmineInterface;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TarefaIdentificacao extends Component
{

    public $prioridades;

    public $tipos;

    public $status;

    /**
     * Create a new component instance.
     */
    public function __construct(private FetchRedmineInterface $fetchRedmine)
    {
        $this->prioridades = $this->fetchRedmine->prioridadesTarefa();
        $this->tipos = $this->fetchRedmine->tiposTarefa();
        $this->status = $this->fetchRedmine->statusTarefa();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.backlog.tarefa-identificacao');
    }
}
