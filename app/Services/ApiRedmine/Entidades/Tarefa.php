<?php

namespace App\Services\ApiRedmine\Entidades;
use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Illuminate\Http\Client\Response;
use Livewire\Wireable;

class Tarefa implements Wireable
{
    /**
     * Identificador da tarefa
     * @var int
     */
    private ?int $id = null;

    /**
     * Assunto da tarefa
     * @var string
     */
    private ?string $assunto = null;

    /**
     * Descrição/Resumo da tarefa
     * @var
     */
    private ?string $descricao = null;

    /**
     * Número de horas estimada para conclusão da tarefa
     * @var int
     */
    private ?int $horasEstimadas = null;

    /**
     * Projeto ao qual a tarefa pertence
     * @var Projeto
     */
    private ?Projeto $projeto = null;

    /**
     * Objeto de status da tarefa
     * @var TarefaStatus
     */
    private ?TarefaStatus $status = null;

    /**
     * Objeto de prioridade da tarefa
     * @var TarefaPrioridade
     */
    private ?TarefaPrioridade $prioridade = null;

    /**
     * Data em que a tarefa deve ser iniciada
     * @var \DateTime
     */
    private ?\DateTime $dataInicio = null;

    /**
     * Data de conclusão estimada para a tarefa
     * @var\DateTime
     */
    private ?\DateTime $dataConclusaoEstimada = null;

    /**
     * Data em que a tarefa foi criada
     * @var \DateTime
     */
    private ?\DateTime $dataCriacao = null;

    /**
     * Data da última atualização da tarefa
     * @var \DateTime
     */
    private ?\DateTime $dataAtualizacao = null;

    /**
     * Data em que a tarefa foi concluída
     * @var \DateTime
     */
    private ?\DateTime $dataConclusao = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getAssunto(): ?string
    {
        return $this->assunto;
    }

    public function setAssunto(?string $assunto): self
    {
        $this->assunto = $assunto;
        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getHorasEstimadas(): ?int
    {
        return $this->horasEstimadas;
    }

    public function setHorasEstimadas(?int $horasEstimadas): self
    {
        $this->horasEstimadas = $horasEstimadas;
        return $this;
    }

    public function getProjeto(): ?Projeto
    {
        return $this->projeto;
    }

    public function setProjeto(?Projeto $projeto): self
    {
        $this->projeto = $projeto;
        return $this;
    }

    public function getStatus(): TarefaStatus
    {
        return $this->status;
    }

    public function setStatus(?TarefaStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPrioridade(): ?TarefaPrioridade
    {
        return $this->prioridade;
    }

    public function setPrioridade(?TarefaPrioridade $prioridade): self
    {
        $this->prioridade = $prioridade;
        return $this;
    }

    public function getDataInicio(): ?\DateTime
    {
        return $this->dataInicio;
    }

    public function setDataInicio(?\DateTime $dataInicio): self
    {
        $this->dataInicio = $dataInicio;
        return $this;
    }

    public function getDataConclusaoEstimada(): ?\DateTime
    {
        return $this->dataConclusaoEstimada;
    }

    public function setDataConclusaoEstimada(?\DateTime $dataConclusaoEstimada): self
    {
        $this->dataConclusaoEstimada = $dataConclusaoEstimada;
        return $this;
    }

    public function getDataCriacao(): ?\DateTime
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(?\DateTime $dataCriacao): self
    {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }

    public function getDataAtualizacao(): ?\DateTime
    {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao(?\DateTime $dataAtualizacao): self
    {
        $this->dataAtualizacao = $dataAtualizacao;
        return $this;
    }

    public function getDataConclusao(): ?\DateTime
    {
        return $this->dataConclusao;
    }

    public function setDataConclusao(?\DateTime $dataConclusao): self
    {
        $this->dataConclusao = $dataConclusao;
        return $this;
    }

    /**
     * Retorna objeto de parâmetros para busca de tarefas no redmine
     *
     * @param int $registrosPorPagina
     * @return Parametros<Tarefa[]>
     */
    public static function parametroListar(int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                $tarefa = new Tarefa();

                $tarefa->setId($dados['id']);
                $tarefa->setAssunto($dados['subject'] ?? null);
                $tarefa->setDescricao($dados['description'] ?? null);

                if (isset($dados['project']['id'])) {
                    $tarefa->setProjeto(
                        (new Projeto)
                            ->setId($dados['project']['id'])
                            ->setNome($dados['project']['name'] ?? null)
                    );
                }

                if (isset($dados['status']['id'])) {
                    $tarefa->setStatus(
                        (new TarefaStatus)
                            ->setId($dados['status']['id'])
                            ->setNome($dados['status']['name'] ?? null)
                    );
                }

                if (isset($dados['priority']['id'])) {
                    $tarefa->setPrioridade(
                        (new TarefaPrioridade)
                            ->setId($dados['priority']['id'])
                            ->setNome($dados['priority']['name'] ?? null)
                    );
                }

                if (isset($dados['start_date'])) {
                    if ($dataInicio = \DateTime::createFromFormat('Y-m-d', $dados['start_date'])) {
                        $dataInicio->setTime(0, 0, 0, 0);
                        $tarefa->setDataInicio($dataInicio);
                    }
                }

                if (isset($dados['created_on'])) {
                    if ($dataCriacao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $dados['created_on'])) {
                        $tarefa->setDataCriacao($dataCriacao);
                    }
                }

                if (isset($dados['updated_on'])) {
                    if ($dataAtualizacao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $dados['updated_on'])) {
                        $tarefa->setDataAtualizacao($dataAtualizacao);
                    }
                }

                if (isset($dados['closed_on'])) {
                    if ($dataConclusao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $dados['closed_on'])) {
                        $tarefa->setDataConclusao($dataConclusao);
                    }
                }

                return $tarefa;
            }, $response->json('issues', []));
        };

        $parametro = new Parametros(
            new Caminho('/issues.json'),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );

        $parametro->filtro()->igual('status_id', '*');

        return $parametro;
    }

    /**
     * {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'assunto' => $this->getAssunto(),
            'descricao' => $this->getDescricao(),
            'horasEstimadas' => $this->getHorasEstimadas(),
            'projeto' => $this->getProjeto(),
            'status' => $this->getStatus(),
            'prioridade' => $this->getPrioridade(),
            'dataInicio' => $this->getDataInicio(),
            'dataConclusaoEstimada' => $this->getDataConclusaoEstimada(),
            'dataCriacao' => $this->getDataCriacao(),
            'dataAtualizacao' => $this->getDataAtualizacao(),
            'dataConclusao' => $this->getDataConclusao(),
        ];
    }

    /**
     * {@inheritDoc}
     */

    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setAssunto($value['assunto'])
            ->setDescricao($value['descricao'])
            ->setHorasEstimadas($value['horasEstimadas'])
            ->setProjeto($value['projeto'])
            ->setStatus($value['status'])
            ->setPrioridade($value['prioridade'])
            ->setDataInicio($value['dataInicio'])
            ->setDataConclusaoEstimada($value['dataConclusaoEstimada'])
            ->setDataCriacao($value['dataCriacao'])
            ->setDataAtualizacao($value['dataAtualizacao'])
            ->setDataConclusao($value['dataConclusao']);
    }
}
