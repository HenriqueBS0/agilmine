<?php

namespace App\Livewire\Home\ProjetosArquivados;

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
        $this->projetos = $service->getProjetos()->where('arquivado', true)->get();
    }

    public function desarquivar($projetoId, ProjetoService $service)
    {
        $projeto = Projeto::find($projetoId);

        $this->authorize('isGestor', $projeto);

        $service->arquivamento($projeto, false);

        $this->projetos = $service->getProjetos()->where('arquivado', true)->get();

        $this->alertaSucesso(__('messages.projeto_desarquivado', ['nome' => $projeto->nome]));
    }

    public function render()
    {
        return view('livewire.home.projetos-arquivados.pagina');
    }
}
