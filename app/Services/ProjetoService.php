<?php

namespace App\Services;

use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Projeto as DadosProjeto;
use App\Models\Projeto;
use App\Models\ProjetoMembro;
use App\Models\MembroRegra;
use Auth;
use Gate;

class ProjetoService
{
    public function getProjetos()
    {
        $projetos = ApiRedmine::listar(DadosProjeto::parametroListar(registrosPorPagina: 100))->dados();

        $this->atualizarProjetos($projetos);


        $ids = array_map(fn(DadosProjeto $projeto) => $projeto->getId(), $projetos);

        // Pega o ID do usuário logado no Redmine
        $idUsuarioRedmine = Auth::user()->getRedmineId();

        if (!$idUsuarioRedmine) {
            return Projeto::whereIn('id', []); // Retorna vazio se o usuário não tiver ID do Redmine
        }

        // Filtra os projetos em que o usuário é membro
        return Projeto::whereIn('id', $ids)
            ->whereHas('membros', function ($query) use ($idUsuarioRedmine) {
                $query->where('membro', $idUsuarioRedmine);
            });
    }

    /**
     * Atualiza os projetos no banco de dados conforme os projetos retornados na api
     *
     * @param DadosProjeto[] $projetos
     * @return void
     */
    private function atualizarProjetos(array $projetos)
    {
        foreach ($projetos as $projeto) {
            $projetoModel = Projeto::updateOrCreate([
                'id' => $projeto->getId(),
                'nome' => $projeto->getNome(),
                'descricao' => $projeto->getDescricao()
            ]);
            $this->atualizarMembrosDoProjeto($projetoModel);
        }
    }

    /**
     * Atualiza os membros de um projeto no banco de dados.
     *
     * @param Projeto $projeto
     * @return void
     */
    public function atualizarMembrosDoProjeto(Projeto $projeto)
    {
        $membros = ApiRedmine::listar(Membro::parametroListar($projeto->id, 100))->dados();

        $idsMembros = [];

        // Processa cada membro
        foreach ($membros as $membro) {
            $projetoMembro = ProjetoMembro::updateOrCreate(
                [
                    'projeto_id' => $projeto->id,
                    'membro' => $membro->getUsuario()->getId(),
                    'nome' => $membro->getUsuario()->getNome()
                ]
            );

            // Atualiza as regras do membro
            $this->atualizarRegrasDoMembro($projetoMembro, $membro->getPerfis());

            $idsMembros[] = $projetoMembro->membro;
        }

        ProjetoMembro::where('projeto_id', $projeto->id)
            ->whereNotIn('membro', $idsMembros)
            ->delete();
    }

    /**
     * Atualiza as regras de um membro no banco de dados.
     *
     * @param ProjetoMembro $projetoMembro
     * @param \App\Services\ApiRedmine\Entidades\PerfilProjeto[] $regras
     * @return void
     */
    private function atualizarRegrasDoMembro(ProjetoMembro $projetoMembro, array $regras)
    {
        $idsRegras = [];

        foreach ($regras as $regra) {
            $regraModel = MembroRegra::updateOrCreate(
                [
                    'membro' => $projetoMembro->id,
                    'regra' => $regra->getId(),
                ]
            );

            $idsRegras[] = $regra->getId();
        }

        // Remove regras que não estão mais associadas ao membro
        MembroRegra::where('membro', $projetoMembro->id)
            ->whereNotIn('regra', $idsRegras)
            ->delete();
    }

    public function arquivamento(Projeto $projeto, bool $arquivar)
    {
        if (Gate::denies('isGestor', $projeto)) {
            return;
        }

        $projeto->arquivado = $arquivar;
        $projeto->save();
    }
}