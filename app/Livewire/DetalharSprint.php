<?php

namespace App\Livewire;

use App\Livewire\Dto\NavbarBreadCrumbItem;
use App\Models\Sprint;
use App\Services\ApiReadmine\ApiReadmine;
use App\Services\ApiReadmine\Entidades\Projeto;
use App\Services\ApiReadmine\Entidades\Tarefa;
use App\Services\ApiReadmine\OpcoesBusca;
use Date;
use DateTime;
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

        $this->tarefas = array_filter($this->tarefas, function (Tarefa $tarefa) {
            return in_array($tarefa->getId(), $this->sprint->tarefas_id);
        });

        usort($this->tarefas, function (Tarefa $tarefaA, Tarefa $tarefaB) {
            return $tarefaA->getDataConclusao() >= $tarefaB->getDataConclusao();
        });
    }

    private function iniciaProjeto()
    {
        $this->projeto = (new ApiReadmine)->getFromId(Projeto::class, $this->sprint->project_id)->getData();
    }

    private function configurarGrafico()
    {

        $numeroTarefasSprint = count($this->tarefas);
        $numeroDiasSprit = count($this->sprint->dias);

        $labels = array_map(function (DateTime $dia) {
            return $dia->format('d/m/Y');
        }, $this->sprint->dias);
        $esperado = self::getEsperado($numeroDiasSprit, $numeroTarefasSprint);
        $realizado = [];

        $tarefasNaoConcluidas = $this->tarefas;

        for ($indiceDia = 0; $indiceDia < $numeroDiasSprit; $indiceDia++) {

            $dataDia = $this->sprint->dias[$indiceDia];

            $tarefasNaoConcluidas = array_filter($tarefasNaoConcluidas, function (Tarefa $tarefa) use ($dataDia) {
                return $tarefa->getDataConclusao() == null || $tarefa->getDataConclusao()->setTime(0, 0, 0, 0) > $dataDia;
            });

            $realizado[] = count($tarefasNaoConcluidas);
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

        $realizado = array_map(function ($tarefaNaoConcluidas) use ($numeroTarefasSprint) {
            return $numeroTarefasSprint - $tarefaNaoConcluidas;
        }, $realizado);

        $esperado = array_map(function ($tarefaNaoConcluidas) use ($numeroTarefasSprint) {
            return $numeroTarefasSprint - $tarefaNaoConcluidas;
        }, $esperado);

        $this->configuracaoBurnUp = [
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
                        'text' => 'Burnup'
                    ]
                ]
            ]
        ];
    }

    private static function getEsperado(int $dias, int $tarefas)
    {
        $tarefasPorDia = floor($tarefas / ($dias - 1));
        $tarefasRestantes = $tarefas % ($dias - 1);
        $tarefasAbertas = $tarefas;

        $esperado = [$tarefasAbertas];

        for ($dia = 0; $dia < ($dias - 1); $dia++) {
            $tarefasAbertas -= $tarefasPorDia + ($dia < $tarefasRestantes ? 1 : 0);
            $esperado[] = $tarefasAbertas;
        }

        return $esperado;
    }

    public function render()
    {
        return view('livewire.detalhar-sprint');
    }
}
