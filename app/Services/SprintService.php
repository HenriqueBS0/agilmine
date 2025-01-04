<?php

namespace App\Services;

use App\Models\Enums\EventoTipo;
use App\Models\Enums\SprintStatus;
use App\Models\Sprint;
use App\Models\SprintEvento;
use App\Services\ApiRedmine\Entidades\Tarefa;

class SprintService
{
    public function __construct(private TarefaService $tarefaService, private DataTimeUtil $dataTimeUtil)
    {
    }

    /**
     * Retorna as tarefas da sprint
     * 
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefas
     * @return \App\Services\ApiRedmine\Entidades\Tarefa[]
     */
    public function getTarefas(Sprint $sprint, $tarefas)
    {
        $tarefas = $this->tarefaService->filtraTarefasContidasNoArray($tarefas, $sprint->tarefas);
        $tarefas = $this->tarefaService->ordenaTarefasArrayIds($tarefas, $sprint->tarefas);
        return $tarefas;
    }

    /**
     * Retorna as tarefas que podem ser adicionadas a sprint
     * 
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefas
     * @return \App\Services\ApiRedmine\Entidades\Tarefa[]
     */
    public function getTarefasSelecionar(Sprint $sprint, $tarefas)
    {
        $tarefaOutrasReleases = $sprint->projeto->sprints()
            ->where('cancelada', false)
            ->pluck('tarefas')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return $this->tarefaService->filtraTarefasNaoContidasNoArray($tarefas, $tarefaOutrasReleases);
    }

    /**
     * Retorna a versao da sprint
     * 
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Versao[] $versoes
     * @return ?\App\Services\ApiRedmine\Entidades\Versao
     */
    public function getVersao(Sprint $sprint, $versoes)
    {
        foreach ($versoes as $versao) {
            if ($versao->getId() == $sprint->versao) {
                return $versao;
            }
        }

        return null;
    }

    /**
     * Retorna o Status da sprint
     * 
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefas
     * @return \App\Models\Enums\SprintStatus
     */
    public function getStatus(Sprint $sprint, $tarefas)
    {
        if ($sprint->cancelada) {
            return SprintStatus::CANCELADA;
        }

        $tarefas = $this->getTarefas($sprint, $tarefas);

        $todasTarefasFechada = count($this->getTarefasFechadas($sprint, $tarefas)) === count($tarefas);

        if ($todasTarefasFechada) {
            return SprintStatus::CONCLUIDA;
        }

        if ($sprint->data_fim->endOfDay() >= now()->endOfDay()) {
            return SprintStatus::EM_ANDAMENTO;
        }

        return SprintStatus::EM_ANDAMENTO_ATRASADA;
    }

    public function getTarefasFechadas(Sprint $sprint, $tarefas)
    {
        $tarefas = $this->getTarefas($sprint, $tarefas);
        return $this->tarefaService->filtraTarefasStatusFechada($tarefas);
    }

    public function getProporcaoFeita(Sprint $sprint, $tarefas): float
    {
        $tarefas = $this->getTarefas($sprint, $tarefas);

        if (count($tarefas) === 0) {
            return 100.0;
        }

        return round(array_reduce(
            $tarefas,
            function ($proporcao, Tarefa $tarefa) {
                return ($proporcao + $tarefa->getProporcaoFeita()) / 2;
            },
            $tarefas[0]->getProporcaoFeita()
        ), 2);
    }

    public function getCor(Sprint $sprint, $tarefas)
    {
        $tipoSprint = $sprint->gera_release ? 'release' : 'sprint';

        $configuracao = $sprint->projeto->configuracao;

        $cores = [
            SprintStatus::EM_ANDAMENTO->value => $configuracao->{"cor_{$tipoSprint}_andamento"},
            SprintStatus::EM_ANDAMENTO_ATRASADA->value => $configuracao->{"cor_{$tipoSprint}_atrasada"},
            SprintStatus::CONCLUIDA->value => $configuracao->{"cor_{$tipoSprint}_concluida"},
            SprintStatus::CANCELADA->value => $configuracao->{"cor_{$tipoSprint}_cancelada"},
        ];

        return $cores[$this->getStatus($sprint, $tarefas)->value];
    }

    public function getTiposEventoDisponiveis(Sprint $sprint, ?SprintEvento $evento = null)
    {
        // Sempre disponíveis
        $disponiveis = [
            EventoTipo::DIARIA,
            EventoTipo::SEMANAL,
        ];

        $eventos = $sprint->eventos();

        if ($evento) {
            $eventos = $eventos->whereNot('id', $evento->id);
        }

        // Verificar se planejamento, revisão ou retrospectiva já existem
        $eventosExistentes = $eventos->pluck('tipo')->toArray();

        if (!in_array(EventoTipo::PLANEJAMENTO, $eventosExistentes)) {
            $disponiveis[] = EventoTipo::PLANEJAMENTO;
        }

        if (!in_array(EventoTipo::REVISAO, $eventosExistentes)) {
            $disponiveis[] = EventoTipo::REVISAO;
        }

        if (!in_array(EventoTipo::RETROSPECTIVA, $eventosExistentes)) {
            $disponiveis[] = EventoTipo::RETROSPECTIVA;
        }

        return $disponiveis;
    }

    public function dias(Sprint $sprint)
    {
        /** @var \Illuminate\Support\Carbon $dataIncial  */
        $dataIncial = clone $sprint->data_inicio;

        /** @var \Illuminate\Support\Carbon $dataFinal  */
        $dataFinal = clone $sprint->data_fim;

        $dataIncial->startOfDay();

        $dataFinal->endOfDay();

        return $this->dataTimeUtil->gerarDiasUteis($dataIncial, $dataFinal);
    }

    public function diasPercorridos(Sprint $sprint)
    {
        $dias = [];

        $hoje = now()->startOfDay();

        foreach ($this->dias($sprint) as $dia) {
            if ($dia >= $hoje) {
                break;
            }

            $dias[] = $dia;
        }

        return $dias;
    }

    /**
     * Filtra as sprints pelo Status
     * 
     * @param Sprint[] $sprints - Sprints
     * @param Tarefa[] $tarefasSprints - Todas as tarefas das sprints
     * @param SprintStatus[] $status - Status que vai filtrar
     * @return Sprint[]
     */
    public function filtraSprintsPelosStatus(array $sprints, array $tarefas, array $status)
    {
        return array_values(array_filter(
            $sprints,
            function (Sprint $sprint) use ($status, $tarefas) {
                $statusSprint = $this->getStatus(
                    $sprint,
                    $this->getTarefas($sprint, $tarefas)
                );

                return in_array($statusSprint, $status);
            }
        ));
    }
}
