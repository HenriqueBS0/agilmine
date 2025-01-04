<?php

namespace App\Services;

use App\Contracts\FetchRedmineInterface;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\ApiRedmine\Entidades\Usuario;
use Illuminate\Support\Carbon;

class TarefaService
{

    public function __construct(private FetchRedmineInterface $fetchRedmine)
    {
    }

    /**
     * Preenche os dados das tarefas
     * 
     * @param Tarefa[] $tarefas
     * @return Tarefa[]
     */
    public function preencherTarefas($tarefas)
    {
        return array_map(fn($t) => self::preencher($t), $tarefas);
    }

    /**
     * Preenche os dados da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencher(Tarefa $tarefa)
    {
        $tarefa = self::preencherMembros($tarefa);
        $tarefa = self::preencherPontosHistoria($tarefa);
        $tarefa = self::preencherPrioridade($tarefa);
        $tarefa = self::preencherTipo($tarefa);
        $tarefa = self::preencherStatus($tarefa);

        return $tarefa;
    }

    /**
     * Preenche os membros da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencherMembros(Tarefa $tarefa)
    {
        static $membros = [];

        $projeto = $tarefa->getProjeto()->getId();

        if (!isset($membros[$projeto])) {
            $membrosProjeto = [];

            foreach ($this->fetchRedmine->membros($projeto) as $membro) {
                $membrosProjeto[$membro->getUsuario()->getId()] = $membro;
            }

            $membros[$projeto] = $membrosProjeto;
        }

        if (isset($membros[$projeto][$tarefa->getAutor()->getId()])) {
            $tarefa->setAutor($membros[$projeto][$tarefa->getAutor()->getId()]->getUsuario());
        }

        if (isset($membros[$projeto][$tarefa->getDesenvolvedor()->getId()])) {
            $tarefa->setDesenvolvedor($membros[$projeto][$tarefa->getDesenvolvedor()->getId()]->getUsuario());
        }

        if (isset($membros[$projeto][$tarefa->getDescritor()->getId()])) {
            $tarefa->setDescritor($membros[$projeto][$tarefa->getDescritor()->getId()]->getUsuario());
        }

        if (isset($membros[$projeto][$tarefa->getTestador()->getId()])) {
            $tarefa->setTestador($membros[$projeto][$tarefa->getTestador()->getId()]->getUsuario());
        }

        return $tarefa;
    }

    /**
     * Preenche os pontos de historia da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencherPontosHistoria(Tarefa $tarefa)
    {
        static $valoresStoryPoints;

        if (!isset($valoresStoryPoints)) {
            $valoresPossiveis = $this->fetchRedmine->campoStoryPoints()?->getValoresPossiveis() ?? [];

            foreach ($valoresPossiveis as $opcao) {
                $valoresStoryPoints[$opcao['value']] = (int) $opcao['label'];
            }
        }

        if (isset($valoresStoryPoints[$tarefa->getPontosHistoriaCampoSelecionado()])) {
            $tarefa->setPontosHistoria($valoresStoryPoints[$tarefa->getPontosHistoriaCampoSelecionado()]);
        } else {
            $tarefa->setPontosHistoria(0);
        }

        return $tarefa;
    }

    /**
     * Preenche a prioridade da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencherPrioridade(Tarefa $tarefa)
    {
        static $prioridades;

        if (!isset($prioridades)) {
            $prioridades = [];

            foreach ($this->fetchRedmine->prioridadesTarefa() as $prioridade) {
                $prioridades[$prioridade->getId()] = $prioridade;
            }
        }

        if (isset($prioridades[$tarefa->getPrioridade()->getId()])) {
            $tarefa->setPrioridade($prioridades[$tarefa->getPrioridade()->getId()]);
        }

        return $tarefa;
    }

    /**
     * Preenche o tipo da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencherTipo(Tarefa $tarefa)
    {
        static $tipos;

        if (!isset($tipos)) {
            $tipos = [];

            foreach ($this->fetchRedmine->tiposTarefa() as $tipo) {
                $tipos[$tipo->getId()] = $tipo;
            }
        }

        if (isset($tipos[$tarefa->getTipo()->getId()])) {
            $tarefa->setTipo($tipos[$tarefa->getTipo()->getId()]);
        }

        return $tarefa;
    }

    /**
     * Preenche o status da tarefa
     * 
     * @param Tarefa $tarefa
     * @return Tarefa
     */
    private function preencherStatus(Tarefa $tarefa)
    {
        static $status;

        if (!isset($status)) {
            $status = [];

            foreach ($this->fetchRedmine->statusTarefa() as $statusItem) {
                $status[$statusItem->getId()] = $statusItem;
            }
        }

        if (isset($status[$tarefa->getStatus()->getId()])) {
            $tarefa->setStatus($status[$tarefa->getStatus()->getId()]);
        }

        return $tarefa;
    }


    /**
     * Ordena as tarefas pelo id usando o array de ids.
     * Tarefas não contidas no array de ids serão postas ao final na ordem informada
     * 
     * @param Tarefa[] $tarefas
     * @param array $ids
     * 
     * @return Tarefa[]
     */
    public function ordenaTarefasArrayIds(array $tarefas, array $ids)
    {
        $tarefasContidasNoArray = $this->filtraTarefasContidasNoArray($tarefas, $ids);
        $tarefasNaoContidasNoArray = $this->filtraTarefasNaoContidasNoArray($tarefas, $ids);

        $idPosicoes = array_flip(array_values($ids));

        usort($tarefasContidasNoArray, fn(Tarefa $a, Tarefa $b) => $idPosicoes[$a->getId()] <=> $idPosicoes[$b->getId()]);

        return array_merge($tarefasContidasNoArray, $tarefasNaoContidasNoArray);
    }

    /**
     * Retorna as tarefas cujo id está no array de ids
     * 
     * @param Tarefa[] $tarefas
     * @param int[] $ids
     * @return Tarefa[]
     */
    public function filtraTarefasNaoContidasNoArray(array $tarefas, array $ids)
    {
        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($ids) {
                return !in_array($tarefa->getId(), $ids);
            }
        ));
    }

    /**
     * Retorna as tarefas cujo id está no array de ids
     * 
     * @param Tarefa[] $tarefas
     * @param int[] $ids
     * @return Tarefa[]
     */
    public function filtraTarefasContidasNoArray(array $tarefas, array $ids)
    {
        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($ids) {
                return in_array($tarefa->getId(), $ids);
            }
        ));
    }

    /**
     * Retorna as tarefas que são do desenvolvedor
     * 
     * @param Tarefa[] $tarefas
     * @param Carbon $data
     * @return Tarefa[]
     */
    public function filtraTarefasDesenvolvedor($tarefas, Usuario $desenvolvedor)
    {
        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($desenvolvedor) {
                return $tarefa->getDesenvolvedor()?->getId() === $desenvolvedor->getId();
            }
        ));
    }

    /**
     * Retorna as tarefas com data de conclusão menor ou igual a data informada
     * 
     * @param Tarefa[] $tarefas
     * @param Carbon $data
     * @return Tarefa[]
     */
    public function filtraTarefasDataConclusaoMenorIgual($tarefas, Carbon $data)
    {
        return array_values(array_filter(
            self::filtraTarefasStatusFechada($tarefas),
            function (Tarefa $tarefa) use ($data) {
                $dataConclusao = Carbon::parse($tarefa->getDataConclusao());
                $dataConclusao->setTime(0, 0, 0, 0);
                return $dataConclusao <= $data;
            }
        ));
    }

    /**
     * Retorna as tarefas pelo status da situação 'is_closed'
     * 
     * @param Tarefa[] $tarefas
     * @param bool $fechada
     * @return Tarefa[]
     */
    public function filtraTarefasStatusFechada(array $tarefas, bool $fechada = true)
    {
        return array_values(array_filter(
            $tarefas,
            function (Tarefa $tarefa) use ($fechada) {
                return $tarefa->getStatus()->getFechada() === $fechada;
            }
        ));
    }
}