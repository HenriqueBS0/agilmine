<?php

namespace App\Services;

use App\Contracts\FetchRedmineInterface;
use App\Models\Projeto;
use App\Services\ApiRedmine\Entidades\Tarefa;
use Auth;
use Gate;

class ProjetoService
{
    public function __construct(
        private FetchRedmineInterface $fetchRedmine,
        private TarefaService $tarefaService,
        private UserService $userService
    ) {

    }

    /**
     * Retorna o builder para pegar os projetos
     * 
     * @return Projeto|\Illuminate\Database\Eloquent\Builder
     */
    public function getProjetos()
    {

        /** @var \App\Models\User $user */

        $user = Auth::user();

        // Pega o ID do usuário logado no Redmine
        $idUsuarioRedmine = $this->userService->getRedmineId($user);

        if (!$idUsuarioRedmine) {
            return Projeto::whereIn('id', []); // Retorna vazio se o usuário não tiver ID do Redmine
        }

        // Filtra os projetos em que o usuário é membro
        return Projeto::whereHas('membros', function ($query) use ($idUsuarioRedmine) {
            $query->where('membro', $idUsuarioRedmine);
        });
    }

    public function arquivamento(Projeto $projeto, bool $arquivar)
    {
        if (Gate::denies('isGestor', $projeto)) {
            return;
        }

        $projeto->arquivado = $arquivar;
        $projeto->save();
    }

    /**
     * Retorna as tarefas do projeto
     * 
     * @param \App\Models\Projeto $projeto
     * @return \App\Services\ApiRedmine\Entidades\Tarefa[]
     */
    public function getTarefas(Projeto $projeto): array
    {
        Gate::authorize('isMembro', $projeto);

        $tarefas = $this->fetchRedmine->tarefas($projeto->id);

        $tarefas = $this->tarefaService->preencherTarefas($tarefas);

        $tarefas = $this->tarefaService->ordenaTarefasArrayIds(
            $tarefas,
            $projeto->tarefas
        );

        $projeto->tarefas = array_map(
            fn(Tarefa $tarefa) => $tarefa->getId(),
            $tarefas
        );

        $projeto->save();

        return $tarefas;
    }

    public function getMembros(Projeto $projeto)
    {
        $membros = [];

        foreach ($this->fetchRedmine->membros($projeto->id) as $membro) {
            $membros[$membro->getUsuario()->getId()] = $membro;
        }

        return $membros;
    }

    public function getVercoes(Projeto $projeto)
    {
        return $this->fetchRedmine->vercoes($projeto->id);
    }

    /**
     * Retorna as sprints aptas a gerar métricas
     * 
     * @param \App\Models\Projeto $projeto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getSprintsMetricas(Projeto $projeto)
    {
        return $projeto->sprints()->where('cancelada', false);
    }
}
