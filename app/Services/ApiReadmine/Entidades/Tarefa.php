<?php

namespace App\Services\ApiReadmine\Entidades;
use Livewire\Wireable;

class Tarefa implements Entidade, Wireable
{
    private ?int $id = null;
    private ?string $assunto = null;
    private ?string $descricao = null;
    private ?int $horasEstimadas = null;
    private ?Projeto $projeto = null;
    private ?TarefaStatus $status = null;
    private ?TarefaPrioridade $prioridade = null;
    private ?\DateTime $dataInicio = null;
    private ?\DateTime $dataTermino = null;
    private ?\DateTime $dataCriacao = null;
    private ?\DateTime $dataAtualizacao = null;
    private ?\DateTime $dataConclusao = null;



    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of assunto
     */
    public function getAssunto(): ?string
    {
        return $this->assunto;
    }

    /**
     * Set the value of assunto
     */
    public function setAssunto(?string $assunto): self
    {
        $this->assunto = $assunto;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of horasEstimadas
     */
    public function getHorasEstimadas(): ?int
    {
        return $this->horasEstimadas;
    }

    /**
     * Set the value of horasEstimadas
     */
    public function setHorasEstimadas(?int $horasEstimadas): self
    {
        $this->horasEstimadas = $horasEstimadas;

        return $this;
    }

    /**
     * Get the value of projeto
     */
    public function getProjeto(): ?Projeto
    {
        return $this->projeto;
    }

    /**
     * Set the value of projeto
     */
    public function setProjeto(?Projeto $projeto): self
    {
        $this->projeto = $projeto;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): TarefaStatus
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?TarefaStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of prioridade
     */
    public function getPrioridade(): ?TarefaPrioridade
    {
        return $this->prioridade;
    }

    /**
     * Set the value of prioridade
     */
    public function setPrioridade(?TarefaPrioridade $prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    /**
     * Get the value of dataInicio
     */
    public function getDataInicio(): ?\DateTime
    {
        return $this->dataInicio;
    }

    /**
     * Set the value of dataInicio
     */
    public function setDataInicio(?\DateTime $dataInicio): self
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get the value of dataTermino
     */
    public function getDataTermino(): ?\DateTime
    {
        return $this->dataTermino;
    }

    /**
     * Set the value of dataTermino
     */
    public function setDataTermino(?\DateTime $dataTermino): self
    {
        $this->dataTermino = $dataTermino;

        return $this;
    }

    /**
     * Get the value of dataCriacao
     */
    public function getDataCriacao(): ?\DateTime
    {
        return $this->dataCriacao;
    }

    /**
     * Set the value of dataCriacao
     */
    public function setDataCriacao(?\DateTime $dataCriacao): self
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    /**
     * Get the value of dataAtualizacao
     */
    public function getDataAtualizacao(): ?\DateTime
    {
        return $this->dataAtualizacao;
    }

    /**
     * Set the value of dataAtualizacao
     */
    public function setDataAtualizacao(?\DateTime $dataAtualizacao): self
    {
        $this->dataAtualizacao = $dataAtualizacao;

        return $this;
    }

    /**
     * Get the value of dataConclusao
     */
    public function getDataConclusao(): ?\DateTime
    {
        return $this->dataConclusao;
    }

    /**
     * Set the value of dataConclusao
     */
    public function setDataConclusao(?\DateTime $dataConclusao): self
    {
        $this->dataConclusao = $dataConclusao;

        return $this;
    }

    public static function getNomeSingular(): string
    {
        return 'issue';
    }

    public static function getNomePlural(): string
    {
        return 'issues';
    }

    public function fromArray(array $data): self
    {
        $this->setId($data['id'] ?? null);
        $this->setAssunto($data['subject'] ?? null);
        $this->setDescricao($data['description'] ?? null);
        $this->setHorasEstimadas($data['estimated_hours'] ?? null);

        if (isset($data['project'])) {
            $this
                ->setProjeto(new Projeto())
                ->getProjeto()->fromArray($data['project']);
        }

        if (isset($data['status'])) {
            $this
                ->setStatus(new TarefaStatus())
                ->getStatus()->fromArray($data['status']);
        }

        if (isset($data['priority'])) {
            $this
                ->setPrioridade(new TarefaPrioridade())
                ->getPrioridade()->fromArray($data['priority']);
        }

        if (isset($data['start_date'])) {
            if ($dataInicio = \DateTime::createFromFormat('Y-m-d', $data['start_date'])) {
                $dataInicio->setTime(0, 0, 0, 0);
                $this->setDataInicio($dataInicio);
            }
        }

        if (isset($data['due_date'])) {
            if ($dataTermino = \DateTime::createFromFormat('Y-m-d', $data['due_date'])) {
                $dataTermino->setTime(0, 0, 0, 0);
                $this->setDataTermino($dataTermino);
            }
        }

        if (isset($data['created_on'])) {
            if ($dataCriacao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $data['created_on'])) {
                $this->setDataCriacao($dataCriacao);
            }
        }

        if (isset($data['updated_on'])) {
            if ($dataAtualizacao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $data['updated_on'])) {
                $this->setDataAtualizacao($dataAtualizacao);
            }
        }

        if (isset($data['closed_on'])) {
            if ($dataConclusao = \DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $data['closed_on'])) {
                $this->setDataConclusao($dataConclusao);
            }
        }

        return $this;
    }

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
            'dataTermino' => $this->getDataTermino(),
            'dataCriacao' => $this->getDataCriacao(),
            'dataAtualizacao' => $this->getDataAtualizacao(),
            'dataConclusao' => $this->getDataConclusao(),
        ];
    }

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
            ->setDataTermino($value['dataTermino'])
            ->setDataCriacao($value['dataCriacao'])
            ->setDataAtualizacao($value['dataAtualizacao'])
            ->setDataConclusao($value['dataConclusao']);
    }
}
