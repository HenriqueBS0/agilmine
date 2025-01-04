<?php

namespace App\Livewire\Home\Projetos;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    public array $projetos;

    public array $tarefas = [];

    public function mount(ProjetoService $service)
    {
        $this->projetos = $service->getProjetos()->where('arquivado', false)->get()->all();
        $this->setTarefasProjetos($service, $this->projetos);
    }

    /**
     * Busca as tarefas dos projetos e define na classe
     * 
     * @param \App\Services\ProjetoService $service
     * @param Projeto[] $projetos
     * @return void
     */
    private function setTarefasProjetos(ProjetoService $service, array $projetos)
    {
        foreach ($projetos as $projeto) {
            $this->tarefas = array_merge(
                $this->tarefas,
                $service->getTarefas($projeto)
            );
        }
    }

    public function arquivar($projetoId, ProjetoService $service)
    {
        $projeto = Projeto::find($projetoId);

        $this->authorize('isGestor', $projeto);

        $service->arquivamento($projeto, true);

        $this->projetos = $service->getProjetos()->where('arquivado', false)->get()->all();

        $this->alertaSucesso(__('messages.projeto_arquivado', ['nome' => $projeto->nome]));
    }

    public function render()
    {
        return view('livewire.home.projetos.pagina');
    }
}
