<?php

namespace App\Services\ApiReadmine\Entidades;
use App\Services\ApiReadmine\Entidades\Entidade;
use Livewire\Wireable;

class Projeto implements Entidade, Wireable
{
    private ?int $id = null;
    private ?string $nome = null;
    private ?string $descricao = null;

    /**
     * Obtém o valor do atributo id.
     *
     * @return int O valor do atributo id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Define o valor do atributo id.
     *
     * @param int $id O novo valor para o atributo id.
     * @return self Para permitir chamadas fluentes.
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Obtém o valor do atributo nome.
     *
     * @return string O valor do atributo nome.
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Define o valor do atributo nome.
     *
     * @param string $nome O novo valor para o atributo nome.
     * @return self Para permitir chamadas fluentes.
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Obtém o valor do atributo descricao.
     *
     * @return string O valor do atributo descricao.
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Define o valor do atributo descricao.
     *
     * @param string $descricao O novo valor para o atributo descricao.
     * @return self Para permitir chamadas fluentes.
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public static function getNomeSingular(): string
    {
        return 'project';
    }

    public static function getNomePlural(): string
    {
        return 'projects';
    }

    /**
     * {@inheritDoc}
     * @param array{id: int, name: string, description: string} $data
     */
    public function fromArray(array $data): self
    {
        return $this
            ->setId($data['id'] ?? null)
            ->setNome($data['name'] ?? null)
            ->setDescricao($data['description'] ?? null);
    }

    public function toLivewire()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'descricao' => $this->getDescricao()
        ];
    }

    public static function fromLivewire($value)
    {
        return (new static)
            ->setId($value['id'])
            ->setNome($value['nome'])
            ->setDescricao($value['descricao']);
    }
}
