<?php

namespace App\Services\ApiReadmine\Entidades;
use Livewire\Wireable;

class TarefaPrioridade implements Entidade, Wireable
{
    /**
     * @var int
     */
    private ?int $id = null;

    /**
     * @var string
     */
    private ?string $nome = null;


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
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public static function getNomeSingular(): string
    {
        return 'priority';
    }

    public static function getNomePlural(): string
    {
        return 'issue_priorities';
    }

    /**
     * @param array $data
     * @return \App\Services\ApiReadmine\Entidades\TarefaStatus
     */
    public function fromArray(array $data): self
    {
        $this->setId($data['id'] ?? null);
        $this->setNome($data['name' ?? null]);

        return $this;
    }

    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        ];
    }

    public static function fromLivewire($value)
    {
        return (new self)
            ->setId($value['id'])
            ->setNome($value['nome']);
    }
}
