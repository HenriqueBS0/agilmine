<?php

namespace App\Livewire;
use App\Livewire\Dto\NavbarBreadCrumbItem;
use App\Livewire\Forms\SprintForm;
use App\Models\Sprint;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use App\Services\ApiReadmine\Entidades\Tarefa;
use App\Services\ApiReadmine\OpcoesBusca;
use Livewire\Component;

class CriarSprint extends Component
{
    /**
     * @var NavbarBreadCrumbItem[]
     */
    public $navbarBreadCrumbItens;

    public Projeto $projeto;

    public SprintForm $form;

    public array $tarefas;

    public function mount(ApiReadmine $api, int $id)
    {
        $this->form->project_id = $id;
        $this->iniciaProjeto($api, $id);
        $this->iniciaNavbarBreadCrumbItens();
        $this->iniciaTarefas();

    }

    private function iniciaProjeto(ApiReadmine $api, int $id)
    {
        $this->projeto = $api->getFromId(Projeto::class, $id)->getData();
    }

    private function iniciaNavbarBreadCrumbItens()
    {
        $this->navbarBreadCrumbItens = [
            new NavbarBreadCrumbItem(false, 'Projetos', route('projetos-list')),
            new NavbarBreadCrumbItem(false, $this->projeto->getNome(), route('projetos-item', ['id' => $this->projeto->getId()])),
            new NavbarBreadCrumbItem(true, 'Criar Sprint', route('criar-sprint', ['id' => $this->projeto->getId()])),
        ];
    }

    private function iniciaTarefas()
    {
        $this->tarefas = [];

        for ($pagina = 1; !isset($resposta) || $pagina <= $resposta->paginas(); $pagina++) {
            $opcoesBusca = new OpcoesBusca();
            $opcoesBusca->filtro()
                ->igual('project_id', $this->projeto->getId())
                ->igual('status_id', '*')
                ->igual('sort', 'id:desc');
            $opcoesBusca->paginacao()
                ->setLimit(100)
                ->setOffset((($pagina - 1) * 100));
            $resposta = (new ApiReadmine)->getAll(Tarefa::class, $opcoesBusca);

            $this->tarefas = array_merge($this->tarefas, $resposta->getData());
        }

        $tarefasUsadas = Sprint::getAllTarefasUtilizadasOutrasSprints($this->projeto->getId());

        $this->tarefas = array_filter($this->tarefas, function (Tarefa $tarefa) use ($tarefasUsadas) {
            return !in_array($tarefa->getId(), $tarefasUsadas);
        });
    }

    public function salvar()
    {
        $this->form->criar();
        $this->redirectRoute('projetos-item', ['id' => $this->projeto->getId()]);
    }

    public function render()
    {
        return view('livewire.manutencao-sprint')->with(['acao' => 'Criar', 'acaoCor' => 'primary']);
    }
}
