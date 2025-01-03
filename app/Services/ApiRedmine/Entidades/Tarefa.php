<?php

namespace App\Services\ApiRedmine\Entidades;
use App\Services\ApiRedmine\Operacoes\Caminho;
use App\Services\ApiRedmine\Operacoes\Listar\Paginacao\Parametro as Paginacao;
use App\Services\ApiRedmine\Operacoes\Listar\Parametros;
use App\Services\MarkdownService;
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
     * Titulo da tarefa
     * @var string
     */
    private ?string $titulo = null;

    /**
     * Descrição/Resumo da tarefa
     * @var
     */
    private ?string $descricao = null;

    /**
     * Porcentagem de conclusão da tarefa
     * @var float
     */
    private ?float $proporcaoFeita = 0;

    /**
     * Número de horas estimadas para conclusão da tarefa
     * @var float
     */
    private ?float $horasEstimadas = null;

    /**
     * Número de horas gastas para realização da tarefa
     * @var float
     */
    private ?float $horasGastas = null;

    /**
     * Campo Selecionado do Pontos de História
     * @var int
     */
    private ?int $pontosHistoriaCampoSelecionado = 0;

    /**
     * Valor de complexidade da história
     * @var int
     */
    private ?int $pontosHistoria = 0;

    /**
     * Projeto ao qual a tarefa pertence
     * @var Projeto
     */
    private ?Projeto $projeto = null;

    /**
     * Tipo da tarefa
     * @var ?TarefaTipo
     */
    private ?TarefaTipo $tipo = null;

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
     * Autor da tarefa
     * @var ?Usuario
     */
    private ?Usuario $autor = null;

    /**
     * Desenvolvedor da tarefa
     * @var ?Usuario
     */
    private ?Usuario $desenvolvedor = null;

    /**
     * Resposavel por criar descrição da tarefa
     * @var ?Usuario
     */
    private ?Usuario $descritor = null;

    /**
     * Usuario responsavel por testar a tarefa
     * @var ?Usuario
     */
    private ?Usuario $testador = null;

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

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function getDescricaoHtml(): ?string
    {
        return (new MarkdownService)->parse($this->getDescricao());
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getProporcaoFeita(): ?float
    {
        return $this->proporcaoFeita;
    }

    public function setProporcaoFeita(?float $proporcaoFeita): self
    {
        $this->proporcaoFeita = $proporcaoFeita;
        return $this;
    }

    public function getPontosHistoriaCampoSelecionado(): ?int
    {
        return $this->pontosHistoriaCampoSelecionado;
    }

    public function setPontosHistoriaCampoSelecionado(?int $pontosHistoriaCampoSelecionado): self
    {
        $this->pontosHistoriaCampoSelecionado = $pontosHistoriaCampoSelecionado;
        return $this;
    }

    public function getPontosHistoria(): ?int
    {
        return $this->pontosHistoria;
    }

    public function setPontosHistoria(?int $pontosHistoria): self
    {
        $this->pontosHistoria = $pontosHistoria;
        return $this;
    }

    public function getHorasEstimadas(): ?float
    {
        return $this->horasEstimadas;
    }

    public function getStringHorasEstimadas()
    {
        return self::stringfyHoras($this->getHorasEstimadas());
    }

    public function setHorasGastas(?float $horasGastas): self
    {
        $this->horasGastas = $horasGastas;
        return $this;
    }

    public function getHorasGastas(): ?float
    {
        return $this->horasGastas;
    }

    public function getStringHorasGastas()
    {
        return self::stringfyHoras($this->getHorasGastas());
    }

    private static function stringfyHoras(?float $horas): string
    {
        if ($horas == null) {
            return '00:00:00';
        }

        $horasInteiras = (int) $horas;
        $minutos = (int) (($horas - $horasInteiras) * 60);

        return sprintf('%02d:%02d:00', $horasInteiras, $minutos);
    }

    public function setHorasEstimadas(?float $horasEstimadas): self
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

    public function getTipo(): ?TarefaTipo
    {
        return $this->tipo;
    }

    public function setTipo(?TarefaTipo $tipo): self
    {
        $this->tipo = $tipo;
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

    public function getAutor(): ?Usuario
    {
        return $this->autor;
    }

    public function setAutor(?Usuario $autor): self
    {
        $this->autor = $autor;
        return $this;
    }

    public function getDesenvolvedor(): ?Usuario
    {
        return $this->desenvolvedor;
    }

    public function setDesenvolvedor(?Usuario $desenvolvedor): self
    {
        $this->desenvolvedor = $desenvolvedor;
        return $this;
    }

    public function getDescritor(): ?Usuario
    {
        return $this->descritor;
    }

    public function setDescritor(?Usuario $descritor): self
    {
        $this->descritor = $descritor;
        return $this;
    }

    public function getTestador(): ?Usuario
    {
        return $this->testador;
    }

    public function setTestador(?Usuario $testador): self
    {
        $this->testador = $testador;
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
                $tarefa->setTitulo($dados['subject'] ?? null);
                $tarefa->setDescricao($dados['description'] ?? null);
                $tarefa->setProporcaoFeita($dados['done_ratio'] ?? null);
                $tarefa->setHorasEstimadas($dados['total_estimated_hours'] ?? null);
                $tarefa->setHorasGastas($dados['total_spent_hours'] ?? null);

                if (isset($dados['project']['id'])) {
                    $tarefa->setProjeto(
                        (new Projeto)
                            ->setId($dados['project']['id'])
                            ->setNome($dados['project']['name'] ?? null)
                    );
                }

                if (isset($dados['tracker']['id'])) {
                    $tarefa->setTipo(
                        (new TarefaTipo())
                            ->setId($dados['tracker']['id'])
                            ->setNome($dados['tracker']['name'] ?? null)
                    );
                }

                if (isset($dados['status']['id'])) {
                    $tarefa->setStatus(
                        (new TarefaStatus)
                            ->setId($dados['status']['id'])
                            ->setNome($dados['status']['name'] ?? null)
                            ->setFechada($dados['status']['is_closed'] ?? null)
                    );
                }

                if (isset($dados['priority']['id'])) {
                    $tarefa->setPrioridade(
                        (new TarefaPrioridade)
                            ->setId($dados['priority']['id'])
                            ->setNome($dados['priority']['name'] ?? null)
                    );
                }

                if (isset($dados['author']['id'])) {
                    $tarefa->setAutor(
                        (new Usuario())
                            ->setId($dados['author']['id'])
                            ->setNome($dados['author']['name'] ?? null)
                    );
                }

                if (isset($dados['assigned_to']['id'])) {
                    $tarefa->setDesenvolvedor(
                        (new Usuario())
                            ->setId($dados['assigned_to']['id'])
                            ->setNome($dados['assigned_to']['name'] ?? null)
                    );
                }

                if (isset($dados['custom_fields'])) {
                    foreach ($dados['custom_fields'] as $campoCustomizado) {
                        if ($campoCustomizado['id'] == 2) {//Pontos de história
                            $tarefa->setPontosHistoriaCampoSelecionado($campoCustomizado['value'] ?: null);
                        }
                        if ($campoCustomizado['id'] == 3) {//Descritor
                            $tarefa->setDescritor((new Usuario)->setId((int) $campoCustomizado['value']));
                            continue;
                        }
                        if ($campoCustomizado['id'] == 4) {//Testador
                            $tarefa->setTestador((new Usuario)->setId((int) $campoCustomizado['value']));
                            continue;
                        }
                    }
                }

                if (isset($dados['start_date'])) {
                    if ($dataInicio = \DateTime::createFromFormat('Y-m-d', $dados['start_date'])) {
                        $dataInicio->setTime(0, 0, 0, 0);
                        $tarefa->setDataInicio($dataInicio);
                    }
                }

                if (isset($dados['due_date'])) {
                    if ($dataConclusaoEstimada = \DateTime::createFromFormat('Y-m-d', $dados['due_date'])) {
                        $dataConclusaoEstimada->setTime(0, 0, 0, 0);
                        $tarefa->setDataConclusaoEstimada($dataConclusaoEstimada);
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

                if (isset($dados['closed_on']) && $tarefa->getStatus()?->getFechada()) {
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
            'titulo' => $this->getTitulo(),
            'descricao' => $this->getDescricao(),
            'descricaoHtml' => $this->getDescricaoHtml(),
            'proporcaoFeita' => $this->getProporcaoFeita(),
            'pontosHistoria' => $this->getPontosHistoria(),
            'horasEstimadas' => $this->getHorasEstimadas(),
            'stringHorasEstimadas' => $this->getStringHorasEstimadas(),
            'horasGastas' => $this->getHorasGastas(),
            'stringHorasGastas' => $this->getStringHorasGastas(),
            'projeto' => $this->getProjeto(),
            'tipo' => $this->getTipo(),
            'status' => $this->getStatus(),
            'prioridade' => $this->getPrioridade(),
            'autor' => $this->getAutor(),
            'desenvolvedor' => $this->getDesenvolvedor(),
            'descritor' => $this->getDescritor(),
            'testador' => $this->getTestador(),
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
            ->setTitulo($value['titulo'])
            ->setDescricao($value['descricao'])
            ->setProporcaoFeita($value['proporcaoFeita'])
            ->setPontosHistoria($value['pontosHistoria'])
            ->setHorasEstimadas($value['horasEstimadas'])
            ->setHorasGastas($value['horasGastas'])
            ->setProjeto($value['projeto'])
            ->setTipo($value['tipo'])
            ->setStatus($value['status'])
            ->setPrioridade($value['prioridade'])
            ->setAutor($value['autor'])
            ->setDesenvolvedor($value['desenvolvedor'])
            ->setDescritor($value['descritor'])
            ->setTestador($value['testador'])
            ->setDataInicio($value['dataInicio'])
            ->setDataConclusaoEstimada($value['dataConclusaoEstimada'])
            ->setDataCriacao($value['dataCriacao'])
            ->setDataAtualizacao($value['dataAtualizacao'])
            ->setDataConclusao($value['dataConclusao']);
    }
}
