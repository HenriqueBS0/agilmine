<?php

namespace Tests\Feature\Home\Projetos;

use App\Livewire\Home\Projetos\Pagina as PaginaProjetos;
use App\Livewire\Home\ProjetosArquivados\Pagina as PaginaProjetosArquivados;
use App\Models\User;
use App\Models\Projeto as ProjetoModel;
use App\Services\ProjetoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Support\AssercoesAlerta;
use Tests\Support\Factories\ApiRedmine\MembroFactory;
use Tests\Support\FakesApiRedmine;
use Tests\TestCase;

class ProjetosTest extends TestCase
{
    use RefreshDatabase;
    use FakesApiRedmine;
    use AssercoesAlerta;

    private $usuarioRedmine;
    private $projetosRedmine;
    private $usuarioSistema;

    public function testDashboardExibeListaDeProjetos()
    {
        $this->setFakesRedmine();

        $response = $this->get(route('pagina-projetos'));

        $response->assertStatus(200);

        foreach ($this->projetosRedmine as $projeto) {
            $response->assertSee($projeto['name']);
        }
    }

    public function testSomenteProjetosAtivosSaoExibidos()
    {
        $this->setFakesRedmine();

        $arquivados = [];
        $naoArquivados = [];

        //Realiza o processo que importa os projetos do redmine para o sistema
        (new ProjetoService)->getProjetos();

        foreach ($this->projetosRedmine as $key => $projeto) {
            $modelProjeto = ProjetoModel::find($projeto['id']);

            if (($key % 2) == 0) {
                $modelProjeto->arquivado = true;
                $modelProjeto->save();
                $arquivados[] = $modelProjeto;
            } else {
                $modelProjeto->arquivado = false;
                $modelProjeto->save();
                $naoArquivados[] = $modelProjeto;
            }
        }

        $response = $this->get(route('pagina-projetos'));

        foreach ($naoArquivados as $projeto) {
            $response->assertSee($projeto->nome);
        }

        foreach ($arquivados as $projeto) {
            $response->assertDontSee($projeto->nome);
        }
    }

    public function testSomenteProjetosArquivadosSaoExibidos()
    {
        $this->setFakesRedmine();

        $arquivados = [];
        $naoArquivados = [];

        //Realiza o processo que importa os projetos do redmine para o sistema
        (new ProjetoService)->getProjetos();

        foreach ($this->projetosRedmine as $key => $projeto) {
            $modelProjeto = ProjetoModel::find($projeto['id']);

            if (($key % 2) == 0) {
                $modelProjeto->arquivado = true;
                $modelProjeto->save();
                $arquivados[] = $modelProjeto;
            } else {
                $modelProjeto->arquivado = false;
                $modelProjeto->save();
                $naoArquivados[] = $modelProjeto;
            }
        }

        $response = $this->get(route('pagina-projetos-arquivados'));


        foreach ($arquivados as $projeto) {
            $response->assertSee($projeto->nome);
        }

        foreach ($naoArquivados as $projeto) {
            $response->assertDontSee($projeto->nome);
        }
    }

    public function acaoArquivarParaGestores($role, $shouldSeeButton = true)
    {
        $this->setFakesRedmine([$role]);

        //Realiza o processo que importa os projetos do redmine para o sistema e desarquiva todos eles
        (new ProjetoService)->getProjetos()->update(['arquivado' => false]);

        $componente = Livewire::test(PaginaProjetos::class);

        foreach ($this->projetosRedmine as $projeto) {
            $buttonHtml = '<button class="btn btn-secondary" wire:click="arquivar(' . $projeto['id'] . ')">Arquivar</button>';

            if ($shouldSeeButton) {
                $componente->assertSeeHtml($buttonHtml);
            } else {
                $componente->assertDontSeeHtml($buttonHtml);
            }
        }
    }

    public function testAcaoArquivarParaGestoresManager()
    {
        $this->acaoArquivarParaGestores(MembroFactory::ROLE_MANAGER);
    }

    public function testAcaoArquivarParaGestoresTeamLeader()
    {
        $this->acaoArquivarParaGestores(MembroFactory::ROLE_TEAM_LEADER);
    }

    public function testNaoAcessoAcaoArquivarParaNaoGestores()
    {
        $this->acaoArquivarParaGestores(MembroFactory::ROLE_DEVELOPER, false);
    }

    public function acaoDesarquivarParaGestores($role, $shouldSeeButton = true)
    {
        $this->setFakesRedmine([$role]);

        //Realiza o processo que importa os projetos do redmine para o sistema e arquiva todos eles
        (new ProjetoService)->getProjetos()->update(['arquivado' => true]);

        $componente = Livewire::test(PaginaProjetosArquivados::class);

        foreach ($this->projetosRedmine as $projeto) {
            $buttonHtml = '<button class="btn btn-secondary" wire:click="desarquivar(' . $projeto['id'] . ')">Desarquivar</button>';

            if ($shouldSeeButton) {
                $componente->assertSeeHtml($buttonHtml);
            } else {
                $componente->assertDontSeeHtml($buttonHtml);
            }
        }
    }

    public function testAcaoDesarquivarParaGestoresManager()
    {
        $this->acaoDesarquivarParaGestores(MembroFactory::ROLE_MANAGER);
    }

    public function testAcaoDesarquivarParaGestoresTeamLeader()
    {
        $this->acaoDesarquivarParaGestores(MembroFactory::ROLE_TEAM_LEADER);
    }

    public function testNaoAcessoAcaoDesarquivarParaNaoGestores()
    {
        $this->acaoDesarquivarParaGestores(MembroFactory::ROLE_DEVELOPER, false);
    }

    public function testProjetosMovimentadosCorretamenteEntreArquivamento()
    {
        $this->setFakesRedmine([MembroFactory::ROLE_MANAGER]);

        (new ProjetoService)->getProjetos();

        $projeto = ProjetoModel::find($this->projetosRedmine[0]['id']);

        // Verifica estado inicial
        $this->assertProjetoMovimentacao($projeto, true, false);

        // Arquiva o projeto e verifica os estados
        $this->arquivarProjeto($projeto);
        $this->assertProjetoMovimentacao($projeto, false, true);

        // Desarquiva o projeto e verifica os estados
        $this->desarquivarProjeto($projeto);
        $this->assertProjetoMovimentacao($projeto, true, false);
    }

    /**
     * Arquiva um projeto através da interface Livewire.
     *
     * @param ProjetoModel $projeto
     * @return void
     */
    private function arquivarProjeto(ProjetoModel $projeto)
    {
        $componente = Livewire::test(PaginaProjetos::class)
            ->call('arquivar', $projeto->id);

        $this->assertAlertaSucesso(__('messages.projeto_arquivado', ['nome' => $projeto->nome]), $componente);
    }

    /**
     * Desarquiva um projeto através da interface Livewire.
     *
     * @param ProjetoModel $projeto
     * @return void
     */
    private function desarquivarProjeto(ProjetoModel $projeto)
    {
        $componente = Livewire::test(PaginaProjetosArquivados::class)
            ->call('desarquivar', $projeto->id);

        $this->assertAlertaSucesso(__('messages.projeto_desarquivado', ['nome' => $projeto->nome]), $componente);
    }

    /**
     * Verifica se o projeto está corretamente visível ou não em ambas as páginas.
     *
     * @param ProjetoModel $projeto
     * @param bool $inProjetos Espera que o projeto esteja visível na página de projetos.
     * @param bool $inArquivados Espera que o projeto esteja visível na página de arquivados.
     * @return void
     */
    private function assertProjetoMovimentacao(ProjetoModel $projeto, bool $inProjetos, bool $inArquivados)
    {
        $paginaProjetos = Livewire::test(PaginaProjetos::class);
        $paginaProjetosArquivados = Livewire::test(PaginaProjetosArquivados::class);

        if ($inProjetos) {
            $paginaProjetos->assertSee($projeto->nome);
        } else {
            $paginaProjetos->assertDontSee($projeto->nome);
        }

        if ($inArquivados) {
            $paginaProjetosArquivados->assertSee($projeto->nome);
        } else {
            $paginaProjetosArquivados->assertDontSee($projeto->nome);
        }
    }

    private function setFakesRedmine($regrasUsuarioRedmine = [MembroFactory::ROLE_DEVELOPER])
    {
        $this->usuarioRedmine = $this->fakeUsuario();
        $this->projetosRedmine = $this->fakeProjetos(5);

        $this->fakeMembros($this->projetosRedmine, $this->usuarioRedmine, $regrasUsuarioRedmine);

        $this->usuarioSistema = User::factory()->create([
            'key_redmine' => $this->usuarioRedmine['api_key'],
            'id_usuario_redmine' => $this->usuarioRedmine['id']
        ]);

        $this->actingAs($this->usuarioSistema);
    }
}

