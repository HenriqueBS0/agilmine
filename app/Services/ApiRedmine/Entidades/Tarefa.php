<?php

namespace App\Services\ApiRedmine\Entidades;

class Tarefa
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
}
