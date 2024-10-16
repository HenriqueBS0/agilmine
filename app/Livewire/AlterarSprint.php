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

class AlterarSprint extends Component
{
    /**
     * @var NavbarBreadCrumbItem[]
     */
    public $navbarBreadCrumbItens;

    public SprintForm $form;

    public Projeto $projeto;

    public array $tarefas;

    public function mount(Sprint $sprint)
    {
        $this->form->setSprint($sprint);
        $this->iniciaProjeto($sprint);
        $this->iniciaNavbarBreadCrumbItens();
        $this->iniciaTarefas();

    }

    private function iniciaProjeto(Sprint $sprint)
    {
        $this->projeto = (new ApiReadmine)->getFromId(Projeto::class, $sprint->project_id)->getData();
    }

    private function iniciaNavbarBreadCrumbItens()
    {
        $this->navbarBreadCrumbItens = [
            new NavbarBreadCrumbItem(false, 'Projetos', route('projetos-list')),
            new NavbarBreadCrumbItem(false, $this->projeto->getNome(), route('projetos-item', ['id' => $this->projeto->getId()])),
            new NavbarBreadCrumbItem(true, 'Alterar Sprint', route('alterar-sprint', ['id' => $this->projeto->getId(), 'sprint' => $this->form->sprint->id])),
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

        $tarefasUsadas = Sprint::getAllTarefasUtilizadasOutrasSprints($this->projeto->getId(), $this->form->sprint->id);

        $this->tarefas = array_filter($this->tarefas, function (Tarefa $tarefa) use ($tarefasUsadas) {
            return !in_array($tarefa->getId(), $tarefasUsadas);
        });
    }

    public function salvar()
    {
        $this->form->alterar();
        $this->redirectRoute('projetos-item', ['id' => $this->projeto->getId()]);
    }

    public function render()
    {
        return view('livewire.manutencao-sprint')->with(['acao' => 'Alterar', 'acaoCor' => 'warning']);
    }
}
