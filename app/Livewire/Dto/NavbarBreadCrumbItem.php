<?php

namespace App\Livewire\Dto;

use Livewire\Wireable;

class NavbarBreadCrumbItem implements Wireable
{
    private bool $ativo;
    private string $nome;
    private string $link;

    public function __construct(bool $ativo, string $nome, string $link)
    {
        $this->ativo = $ativo;
        $this->nome = $nome;
        $this->link = $link;
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function toLivewire(): array
    {
        return [
            'ativo' => $this->ativo,
            'nome' => $this->nome,
            'link' => $this->link,
        ];
    }

    public static function fromLivewire($value): self
    {
        return new NavbarBreadCrumbItem(
            $value['ativo'],
            $value['nome'],
            $value['link']
        );
    }
}
