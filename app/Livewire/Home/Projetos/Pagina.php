<?php

namespace App\Livewire\Home\Projetos;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use App\Services\ProjetoService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    public $projetos;

    public function mount(ProjetoService $service)
    {
        $this->projetos = $service->getProjetos()->where('arquivado', false)->get();
    }

    public function arquivar($projetoId, ProjetoService $service)
    {
        $projeto = Projeto::find($projetoId);

        $this->authorize('isGestor', $projeto);

        $service->arquivamento($projeto, true);

        $this->projetos = $service->getProjetos()->where('arquivado', false)->get();

        $this->alertaSucesso(__('messages.projeto_arquivado', ['nome' => $projeto->nome]));
    }

    public function render()
    {
        return view('livewire.home.projetos.pagina');
    }
}
