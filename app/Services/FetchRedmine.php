<?php

namespace App\Services;

use App\Contracts\FetchRedmineInterface;
use App\Models\Configuracao;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\CampoCustomizado;
use App\Services\ApiRedmine\Entidades\LancamentoHora;
use App\Services\ApiRedmine\Entidades\Membro;
use App\Services\ApiRedmine\Entidades\Projeto;
use App\Services\ApiRedmine\Entidades\Tarefa;
use App\Services\ApiRedmine\Entidades\TarefaPrioridade;
use App\Services\ApiRedmine\Entidades\TarefaStatus;
use App\Services\ApiRedmine\Entidades\TarefaTipo;
use App\Services\ApiRedmine\Entidades\Usuario;
use App\Services\ApiRedmine\Entidades\Versao;
use App\Services\ApiRedmine\Operacoes\Listar\Retorno;
use Illuminate\Support\Facades\Auth;

class FetchRedmine implements FetchRedmineInterface
{
    /**
     * Lista de projetos
     * 
     * @return Projeto[]
     */
    public function projetos(): array
    {
        $parametro = Projeto::parametroListar(50)->setKey(self::getKeyUser());
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna os dados de um projeto
     * 
     * @param int $id - id do projeto
     * @return Projeto
     */
    public function projeto($id): Projeto
    {
        $parametro = Projeto::parametroFind($id)->setKey(self::getKeyUser());
        return ApiRedmine::listar($parametro)->dados();
    }

    /**
     * Retorna as tarefas de um projeto
     * 
     * @param int $projeto - id do projeto
     * @return Tarefa[]
     */
    public function tarefas(int $projeto): array
    {
        $parametro = Tarefa::parametroListar(100)->setKey(self::getKeyUser());
        $parametro->filtro()->igual('project_id', $projeto);
        $parametro->ordenacao()->crescente('id');

        $retorno = ApiRedmine::listar($parametro);

        return self::all($retorno);
    }

    /**
     * Retorna os membros de um projeto
     * 
     * @param int $projeto - id do Projeto
     * @return Membro[]
     */
    public function membros(int $projeto): array
    {
        $parametro = Membro::parametroListar($projeto, 100)->setKey(self::getKeyUser());
        $retorno = ApiRedmine::listar($parametro);

        return self::all($retorno);
    }

    /**
     * Retorna as versões do projeto
     * 
     * @param int $projeto
     * @return Versao[]
     */
    public function vercoes(int $projeto): array
    {
        $parametro = Versao::parametroListar($projeto, 100)->setKey(self::getKeyUser());
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna o usuário redmine do usuário logado
     * 
     * @return Usuario
     */
    public function usuario(): Usuario
    {
        $parametro = Usuario::parametroListar()->setKey(self::getKeyUser());
        return ApiRedmine::listar($parametro)->dados()[0];
    }

    /**
     * Retorna as prioridades das tarefas
     * 
     * @return TarefaPrioridade[]
     */
    public function prioridadesTarefa(): array
    {
        $parametro = TarefaPrioridade::parametroListar()->setKey(self::getKeyAdmin());
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna os tipos das tarefas
     * 
     * @return TarefaTipo[]
     */
    public function tiposTarefa(): array
    {
        $parametro = TarefaTipo::parametroListar()->setKey(self::getKeyAdmin());
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna os tipos das tarefas
     * 
     * @return TarefaStatus[]
     */
    public function statusTarefa(): array
    {
        $parametro = TarefaStatus::parametroListar()->setKey(self::getKeyAdmin());
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna os lançamentos de horas no projeto
     * 
     * @param int $projeto
     * @return array
     */
    public function lancamentosHorasProjeto(int $projeto): array
    {
        $parametro = LancamentoHora::parametroListar(50)->setKey(self::getKeyUser());
        $parametro->filtro()->igual('project_id', $projeto);
        $retorno = ApiRedmine::listar($parametro);
        return self::all($retorno);
    }

    /**
     * Retorna os campos customizados
     * 
     * @return CampoCustomizado[]
     */
    public function camposCustomizados(): array
    {
        static $camposCustomizados;

        if (!isset($camposCustomizados)) {
            $parametro = CampoCustomizado::parametroListar()->setKey(self::getKeyAdmin());
            $retorno = ApiRedmine::listar($parametro);

            $camposCustomizados = self::all($retorno);
        }

        return $camposCustomizados;
    }

    /**
     * Retorna o campo de story point caso exista
     * 
     * @return ?CampoCustomizado
     */
    public function campoStoryPoints(): ?CampoCustomizado
    {
        foreach ($this->camposCustomizados() as $campo) {
            $nome = strtolower(str_replace(' ', '', $campo->getNome()));

            if ($nome === 'storypoints') {
                return $campo;
            }
        }

        return null;
    }

    /**
     * Percorre toda a paginação retornando todos os registros
     * 
     * @template T
     * @param Retorno<T> $retorno
     * @return T[]
     */
    private function all(Retorno $retorno): array
    {
        $dados = [];

        do {
            $dados = array_merge($dados, $retorno->dados());
        } while ($retorno = $retorno->avancar());

        return $dados;
    }

    /**
     * Retorna a chave do redmine do usuário
     * @return string
     */
    private function getKeyUser(): string
    {
        return Auth::user()->key_redmine ?: '';
    }

    /**
     * Retorna a chave do redmine com permissão administrativa
     * @return string
     */
    private function getKeyAdmin(): string
    {
        return Configuracao::getRedmineAdmKey() ?: '';
    }
}