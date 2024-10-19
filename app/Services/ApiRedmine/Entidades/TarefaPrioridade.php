<?php

namespace App\Services\ApiRedmine\Entidades;
use Livewire\Wireable;

class TarefaPrioridade implements Wireable
{
    /**
     * Identificador da prioridade
     * @var int
     */
    private ?int $id = null;

    /**
     * Nome da prioridade
     * @var string
     */
    private ?string $nome = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setNome($value['nome']);
    }
}
