<?php

namespace App\View\Components\Sprint\Backlog;

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
    public function __construct()
    {
        $this->prioridades = ApiRedmine::listar(TarefaPrioridade::parametroListar())->dados();
        $this->tipos = ApiRedmine::listar(TarefaTipo::parametroListar())->dados();
        $this->status = ApiRedmine::listar(TarefaStatus::parametroListar())->dados();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.backlog.tarefa-identificacao');
    }
}
