<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use \App\Livewire\Dto\Paginacao as PaginacaoData;

class Paginacao extends Component
{

    #[Reactive()]
    public PaginacaoData $paginacao;

    public function mount(PaginacaoData $paginacao)
    {
        $this->paginacao = $paginacao;
    }

    public function atualizarPagina(int $pagina)
    {
        $this->dispatch(
            'atualizacao-paginacao',
            paginacao: $this->paginacao->getIdentificador(),
            pagina: $pagina
        );
    }

    public function render()
    {
        return view('livewire.paginacao');
    }
}
