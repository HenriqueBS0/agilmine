<?php

namespace App\Livewire;

use App\Livewire\Traits\ManipuladorProjeto;
use App\Models\Sprint;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Tarefa;
use Livewire\Component;

class PaginaSprintReport extends Component
{

    use ManipuladorProjeto;

    public Sprint $sprint;

    public array $tarefas;

    public function mount(int $projetoId, Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->setProjeto($projetoId);
        $this->loadTarefas();
    }

    public function loadTarefas()
    {
        $parametros = Tarefa::parametroListar(50);
        $parametros->filtro()->igual('project_id', $this->projeto->getId());
        $parametros->ordenacao()->crescente('id');

        $tarefas = [];
        $resposta = ApiRedmine::listar($parametros);

        do {
            $tarefas = array_merge($tarefas, $resposta->dados());
        } while ($resposta = $resposta->avancar());

        $this->tarefas = array_filter(
            $tarefas,
            fn(Tarefa $tarefa) => in_array($tarefa->getId(), $this->sprint->tarefas)
        );
    }

    public function render()
    {
        return view('livewire.pagina-sprint-report');
    }
}
