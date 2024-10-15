<?php

namespace App\Livewire;

use App\Livewire\Dto\Paginacao;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use App\Services\ApiReadmine\Entidades\Tarefa;
use App\Services\ApiReadmine\OpcoesBusca;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class BacklogList extends Component
{

    private const REGISTROS_PAGINA = 10;

    public Projeto $projeto;

    public array $tarefas;

    public Paginacao $paginacao;

    public function mount(ApiReadmine $api, Projeto $projeto)
    {
        $this->projeto = $projeto;
        $this->paginacao = new Paginacao('backlog-list');
        $this->atualizaTarefas();
    }

    private function atualizaTarefas(int $pagina = 1)
    {
        $opcoesBusca = new OpcoesBusca();
        $opcoesBusca->filtro()->igual('project_id', $this->projeto->getId());
        $opcoesBusca->paginacao()
            ->setLimit(self::REGISTROS_PAGINA)
            ->setOffset(($pagina - 1) * $pagina);
        $resposta = (new ApiReadmine)->getAll(Tarefa::class, $opcoesBusca);

        $this->paginacao->setPaginas($resposta->paginas());
        $this->paginacao->setPaginaAtual($pagina);

        $this->tarefas = $resposta->getData();
    }

    #[On('atualizacao-paginacao')]
    public function onAtualizacaoPaginacao(string $paginacao, int $pagina)
    {
        if ($paginacao !== $this->paginacao->getIdentificador()) {
            return;
        }

        $this->atualizaTarefas($pagina);
    }

    public function render()
    {
        return view('livewire.backlog-list');
    }
}
