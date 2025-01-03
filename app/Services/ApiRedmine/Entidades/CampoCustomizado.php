<?php

namespace App\Services\ApiRedmine\Entidades;

use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use Livewire\Wireable;
use Illuminate\Http\Client\Response;

class CampoCustomizado implements Wireable
{
    /**
     * Id do campo customizado
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Nome do campo customizado
     * @var string|null
     */
    private ?string $nome = null;

    /**
     * Tipo customizado (issue, project, etc.)
     * @var string|null
     */
    private ?string $tipoCustomizado = null;

    /**
     * Formato do campo (text, user, enumeration, etc.)
     * @var string|null
     */
    private ?string $formatoCampo = null;

    /**
     * É obrigatório?
     * @var bool
     */
    private bool $isObrigatorio = false;

    /**
     * Valores possíveis (apenas para enumerations)
     * @var array{value:mixed, label:mixed}[]
     */
    private array $valoresPossiveis = [];

    /**
     * Rastreador associado ao campo
     * @var array
     */
    private array $rastreamentos = [];

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

    public function getTipoCustomizado(): ?string
    {
        return $this->tipoCustomizado;
    }

    public function setTipoCustomizado(?string $tipoCustomizado): self
    {
        $this->tipoCustomizado = $tipoCustomizado;
        return $this;
    }

    public function getFormatoCampo(): ?string
    {
        return $this->formatoCampo;
    }

    public function setFormatoCampo(?string $formatoCampo): self
    {
        $this->formatoCampo = $formatoCampo;
        return $this;
    }

    public function isObrigatorio(): bool
    {
        return $this->isObrigatorio;
    }

    public function setObrigatorio(bool $isObrigatorio): self
    {
        $this->isObrigatorio = $isObrigatorio;
        return $this;
    }

    /**
     * @return array{value:mixed, label:mixed}[]
     */
    public function getValoresPossiveis(): array
    {
        return $this->valoresPossiveis;
    }

    /**
     * @param array{value:mixed, label:mixed}[] $valoresPossiveis
     * @return self
     */
    public function setValoresPossiveis(array $valoresPossiveis): self
    {
        $this->valoresPossiveis = $valoresPossiveis;
        return $this;
    }

    public function getRastreamentos(): array
    {
        return $this->rastreamentos;
    }

    public function setRastreamentos(array $rastreamentos): self
    {
        $this->rastreamentos = $rastreamentos;
        return $this;
    }

    public static function parametroListar(int $registrosPorPagina = 25): Parametros
    {
        $fn = function (Response $response) {
            return array_map(function ($dados) {
                $campoCustomizado = new CampoCustomizado;

                $campoCustomizado->setId($dados['id'] ?? null);
                $campoCustomizado->setNome($dados['name'] ?? null);
                $campoCustomizado->setTipoCustomizado($dados['customized_type'] ?? null);
                $campoCustomizado->setFormatoCampo($dados['field_format'] ?? null);
                $campoCustomizado->setObrigatorio($dados['is_required'] ?? false);

                if (isset($dados['possible_values']) && is_array($dados['possible_values'])) {
                    $campoCustomizado->setValoresPossiveis(
                        array_map(function ($valor) {
                            return [
                                'value' => $valor['value'] ?? null,
                                'label' => $valor['label'] ?? null,
                            ];
                        }, $dados['possible_values'])
                    );
                }

                if (isset($dados['trackers']) && is_array($dados['trackers'])) {
                    $campoCustomizado->setRastreamentos(
                        array_map(function ($rastreador) {
                            return [
                                'id' => $rastreador['id'] ?? null,
                                'name' => $rastreador['name'] ?? null,
                            ];
                        }, $dados['trackers'])
                    );
                }

                return $campoCustomizado;

            }, $response->json('custom_fields', []));
        };

        $parametro = new Parametros(
            new Caminho('/custom_fields.json'),
            $fn,
            new Paginacao(0, $registrosPorPagina)
        );

        return $parametro;
    }


    public function toLivewire(): array
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'tipoCustomizado' => $this->getTipoCustomizado(),
            'formatoCampo' => $this->getFormatoCampo(),
            'isObrigatorio' => $this->isObrigatorio(),
            'valoresPossiveis' => $this->getValoresPossiveis(),
            'rastreamentos' => $this->getRastreamentos(),
        ];
    }

    public static function fromLivewire($value): self
    {
        return (new static)
            ->setId($value['id'] ?? null)
            ->setNome($value['nome'] ?? null)
            ->setTipoCustomizado($value['tipoCustomizado'] ?? null)
            ->setFormatoCampo($value['formatoCampo'] ?? null)
            ->setObrigatorio($value['isObrigatorio'] ?? false)
            ->setValoresPossiveis($value['valoresPossiveis'] ?? [])
            ->setRastreamentos($value['rastreamentos'] ?? []);
    }
}
