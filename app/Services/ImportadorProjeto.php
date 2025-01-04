<?php

namespace App\Services;

use App\Contracts\FetchRedmineInterface;
use App\Models\MembroRegra;
use App\Models\Projeto;
use App\Models\ProjetoMembro;
use App\Services\ApiRedmine\Entidades\Projeto as ProjetoDados;

class ImportadorProjeto
{
    public function __construct(private FetchRedmineInterface $fetchRedmine)
    {
    }

    public function importar(ProjetoDados $projetoDados)
    {
        $projeto = $this->pegarAtualizarProjeto($projetoDados);
        $this->atualizarMembrosDoProjeto($projeto);
    }

    private function pegarAtualizarProjeto(ProjetoDados $projeto): Projeto
    {
        return Projeto::updateOrCreate(
            ['id' => $projeto->getId()],
            [
                'nome' => $projeto->getNome(),
                'descricao' => $projeto->getDescricao()
            ]
        );
    }

    /**
     * Atualiza os membros de um projeto no banco de dados.
     *
     * @param Projeto $projeto
     * @return void
     */
    private function atualizarMembrosDoProjeto(Projeto $projeto)
    {
        $membros = $this->fetchRedmine->membros($projeto->id);

        $idsMembros = [];

        // Processa cada membro
        foreach ($membros as $membro) {
            $projetoMembro = ProjetoMembro::updateOrCreate(
                [
                    'projeto_id' => $projeto->id,
                    'membro' => $membro->getUsuario()->getId()
                ],
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
}