<?php

namespace App\Services;

use App\Models\Enums\SprintStatus;
use App\Models\Sprint;
use App\Services\ApiRedmine\Entidades\Tarefa;

class SprintService
{
    /**
     * Retorna as tarefas da sprint
     * 
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Tarefa[] $tarefas
     * @return \App\Services\ApiRedmine\Entidades\Tarefa[]
     */
    public function getTarefas(Sprint $sprint, $tarefas)
    {
        // Obtem os IDs das tarefas na ordem definida na sprint
        $ordemTarefas = $sprint->tarefas;

        // Mapeia as tarefas recebidas por ID para facilitar a ordenação
        $tarefasMap = [];
        foreach ($tarefas as $tarefa) {
            $tarefasMap[$tarefa->getId()] = $tarefa;
        }

        // Filtra e ordena as tarefas conforme a ordem da sprint
        $tarefasOrdenadas = [];
        foreach ($ordemTarefas as $idTarefa) {
            if (isset($tarefasMap[$idTarefa])) {
                $tarefasOrdenadas[] = $tarefasMap[$idTarefa];
            }
        }

        return $tarefasOrdenadas;
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

        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($tarefaOutrasReleases) {
                return !in_array($tarefa->getId(), $tarefaOutrasReleases);
            }
        ));
    }

    /**
     * Retorna a versao da sprint
     * @param Sprint $sprint
     * @param \App\Services\ApiRedmine\Entidades\Versao[] $versoes
     * @return ?\App\Services\ApiRedmine\Entidades\Versao
     */
    public function getVersao($sprint, $versoes)
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

        return array_values(array_filter($tarefas, function (Tarefa $tarefa) {
            return $tarefa->getStatus()->getFechada();
        }));
    }

    public function getTarefasAbertas(Sprint $sprint, $tarefas)
    {
        $tarefas = $this->getTarefas($sprint, $tarefas);

        return array_values(array_filter($tarefas, function (Tarefa $tarefa) {
            return !$tarefa->getStatus()->getFechada();
        }));
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
}
