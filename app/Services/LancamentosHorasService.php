<?php

namespace App\Services;

use App\Services\ApiRedmine\Entidades\LancamentoHora;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Tarefa;

class LancamentosHorasService
{

    /**
     * Retorna os lançamentos de horas das tarefas
     * 
     * @param Tarefa[] $tarefas
     * @return LancamentoHora[]
     */
    public function getLancamentosHorasTarefas(array $tarefas): array
    {
        $lancamentos = [];

        foreach ($tarefas as $tarefa) {
            $lancamentos = array_merge($lancamentos, $tarefa->getLancamentosHoras());
        }

        return $lancamentos;
    }

    /**
     * Filtra os lançamentos de horas de um determinado membro
     * 
     * @param LancamentoHora[] $lancamentos
     * @param Membro $membro
     * @return array
     */
    public function filtraLancamentosHorasMembro(array $lancamentos, Membro $membro): array
    {
        return array_values(array_filter(
            $lancamentos,
            function (LancamentoHora $lancamento) use ($membro) {
                return $lancamento->getUsuario()->getId() === $membro->getUsuario()->getId();
            }
        ));
    }

    /**
     * Retorna o somatório de horas dos lançamentos
     *
     * @param LancamentoHora[] $lancamentos
     * @return float
     */
    public function somaHorasLancamentos(array $lancamentos): float
    {
        $horas = 0;

        foreach ($lancamentos as $lancamento) {
            $horas += $lancamento->getHoras();
        }

        return $horas;
    }
}