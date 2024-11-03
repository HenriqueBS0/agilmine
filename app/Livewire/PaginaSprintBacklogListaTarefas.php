<?php

namespace App\Livewire;

use Livewire\Component;

class PaginaSprintBacklogListaTarefas extends Component
{

    public string $identificador;

    public string $titulo;

    public string $containerClasses;

    /**
     * @var \App\Services\ApiRedmine\Entidades\Tarefa[]
     */
    public array $tarefas;

    public function mount(string $identificador, string $titulo, string $containerClasses, array $tarefas)
    {
        $this->identificador = $identificador;
        $this->titulo = $titulo;
        $this->containerClasses = $containerClasses;
        $this->tarefas = $tarefas;
    }
    public function render()
    {
        return view('livewire.pagina-sprint-backlog-lista-tarefas');
    }
}
