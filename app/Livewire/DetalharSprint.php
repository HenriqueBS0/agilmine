<?php

namespace App\Livewire;

use App\Livewire\Dto\NavbarBreadCrumbItem;
use App\Models\Sprint;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use App\Services\ApiReadmine\Entidades\Tarefa;
use App\Services\ApiReadmine\OpcoesBusca;
use Date;
use Livewire\Component;

class DetalharSprint extends Component
{
    public array $navbarBreadCrumbItens;
    public Sprint $sprint;

    public Projeto $projeto;

    public array $tarefas;

    public array $configuracaoBurnDown;

    public array $configuracaoBurnUp;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
        $this->iniciaProjeto();
        $this->iniciaNavbarBreadCrumbItens();
        $this->iniciaTarefas();
        $this->configurarGrafico();
    }

    private function iniciaNavbarBreadCrumbItens()
    {
        $this->navbarBreadCrumbItens = [
            new NavbarBreadCrumbItem(false, 'Projetos', route('projetos-list')),
            new NavbarBreadCrumbItem(false, $this->projeto->getNome(), route('projetos-item', ['id' => $this->projeto->getId()])),
            new NavbarBreadCrumbItem(true, $this->sprint->nome, route('datalhar-sprint', [
                'id' => $this->projeto->getId(),
                'sprint' => $this->sprint->id
            ])),
        ];
    }

    private function iniciaTarefas()
    {
        $opcoesBusca = new OpcoesBusca();
        $opcoesBusca->filtro()->igual('project_id', $this->projeto->getId());
        $opcoesBusca->paginacao()->setLimit(100);
        $resposta = (new ApiReadmine)->getAll(Tarefa::class, $opcoesBusca);

        $this->tarefas = array_filter($resposta->getData(), function (Tarefa $tarefa) {
            return in_array($tarefa->getId(), $this->sprint->tarefas_id);
        });

        $this->tarefas = array_map(function (Tarefa $tarefa) {
            $tarefa->setDataConclusao(
                (new \DateTime())->setTimestamp(mt_rand(
                    (new \DateTime($this->sprint->data_inicio))->getTimestamp(),
                    (new \DateTime($this->sprint->data_fim))->getTimestamp()
                ))
            );
            return $tarefa;
        }, $this->tarefas);
    }

    private function iniciaProjeto()
    {
        $this->projeto = (new ApiReadmine)->getFromId(Projeto::class, $this->sprint->project_id)->getData();
    }

    private function configurarGrafico()
    {
        $this->sprint->dias;

        $tarefasNaoConcluidas = $this->tarefas;
        $tarefasInicial = count($this->tarefas);
        $totalEsperado = $tarefasInicial;
        $tarefasEsperadasDia = $tarefasInicial / count($this->sprint->dias);

        $labels = [];
        $realizado = [];
        $esperado = [];

        for ($dia = 1; $dia <= count($this->sprint->dias); $dia++) {
            $indiceDia = $dia - 1;
            $dataDia = $this->sprint->dias[$indiceDia];
            $labels[] = $dia;
            $esperado[] = $totalEsperado;

            $tarefasNaoConcluidas = array_filter($tarefasNaoConcluidas, function (Tarefa $tarefa) use ($dataDia) {
                return $tarefa->getDataConclusao() == null || $tarefa->getDataConclusao() > $dataDia;
            });

            $realizado[] = count($tarefasNaoConcluidas);

            $totalEsperado -= $tarefasEsperadasDia;
        }


        $this->configuracaoBurnDown = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Realizado',
                        'data' => $realizado,
                        'fill' => false,
                        'borderColor' => 'rgb(255, 0, 0)',
                        'tension' => 0.1
                    ],
                    [
                        'label' => 'Planejado',
                        'data' => $esperado,
                        'fill' => false,
                        'borderColor' => 'rgb(0, 0, 255)',
                        'tension' => 0.1,
                    ]
                ]
            ],
            'options' => [
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Burndown'
                    ]
                ]
            ]
        ];

        $this->configuracaoBurnUp = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Realizado',
                        'data' => array_reverse($realizado),
                        'fill' => false,
                        'borderColor' => 'rgb(255, 0, 0)',
                        'tension' => 0.1
                    ],
                    [
                        'label' => 'Planejado',
                        'data' => array_reverse($esperado),
                        'fill' => false,
                        'borderColor' => 'rgb(0, 0, 255)',
                        'tension' => 0.1,
                    ]
                ]
            ],
            'options' => [
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Burnup'
                    ]
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.detalhar-sprint');
    }
}
