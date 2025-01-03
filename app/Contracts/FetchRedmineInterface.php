<?php

namespace App\Contracts;

use App\Services\ApiRedmine\Entidades\CampoCustomizado;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Projeto;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use App\Services\ApiRedmine\Entidades\Usuario;
use App\Services\ApiRedmine\Entidades\Versao;

interface FetchRedmineInterface
{
    /**
     * Lista de projetos
     * 
     * @return Projeto[]
     */
    public function projetos(): array;

    /**
     * Retorna os dados de um projeto
     * 
     * @param int $id - id do projeto
     * @return Projeto
     */
    public function projeto($id): Projeto;

    /**
     * Retorna as tarefas de um projeto
     * 
     * @param int $projeto - id do projeto
     * @return Tarefa[]
     */
    public function tarefas(int $projeto): array;

    /**
     * Retorna os membros de um projeto
     * 
     * @param int $projeto - id do Projeto
     * @return Membro[]
     */
    public function membros(int $projeto): array;

    /**
     * Retorna as versões do projeto
     * 
     * @param int $projeto
     * @return Versao[]
     */
    public function vercoes(int $projeto): array;

    /**
     * Retorna o usuário redmine do usuário logado
     * 
     * @return Usuario
     */
    public function usuario(): Usuario;

    /**
     * Retorna as prioridades das tarefas
     * 
     * @return TarefaPrioridade[]
     */
    public function prioridadesTarefa(): array;

    /**
     * Retorna os tipos das tarefas
     * 
     * @return TarefaTipo[]
     */
    public function tiposTarefa(): array;

    /**
     * Retorna os tipos das tarefas
     * 
     * @return TarefaStatus[]
     */
    public function statusTarefa(): array;

    /**
     * Retorna os campos customizados
     * 
     * @return CampoCustomizado[]
     */
    public function camposCustomizados(): array;

    /**
     * Retorna o campo de story point caso exista
     * 
     * @return ?CampoCustomizado
     */
    public function campoStoryPoints(): ?CampoCustomizado;
}
