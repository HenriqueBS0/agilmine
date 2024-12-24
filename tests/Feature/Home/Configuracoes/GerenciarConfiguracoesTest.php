<?php

namespace Tests\Feature\Home\Configuracoes;

use App\Livewire\Home\Configuracoes\Pagina;
use App\Models\Configuracao;
use App\Models\User;
use Database\Seeders\ConfiguracaoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GerenciarConfiguracoesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = ConfiguracaoSeeder::class;

    /**
     * A basic feature test example.
     */
    public function testApenasAdministradoresPodemAcessarPainelConfiguracoes()
    {
        // Usuário administrador
        $admin = User::factory()->create(['admin' => true]);

        // Usuário comum
        $user = User::factory()->create(['admin' => false]);

        // Simula acesso como administrador
        $this->actingAs($admin)
            ->get(route('pagina-configuracoes'))
            ->assertOk(); // Acesso permitido

        // Simula acesso como usuário comum
        $this->actingAs($user)
            ->get(route('pagina-configuracoes'))
            ->assertForbidden(); // Acesso negado
    }

    public function testAdministradorPodeVisualizarEEditarUrlRedmine()
    {
        // Usuário administrador
        $admin = User::factory()->create(['admin' => true]);

        // Acessa o painel de configurações
        $componente = Livewire::actingAs($admin)->test(Pagina::class);
        $componente->assertSee('URL');

        // Atualiza a URL
        $novaUrl = 'http://nova-url-redmine.com';
        $componente->set('redmineUrl', $novaUrl)->call('salvarConfiguracoesRedmine');

        $this->assertAlertaSucesso(__('messages.config_saved_successfully'), $componente);

        // Verifica se a URL foi atualizada
        $this->assertEquals($novaUrl, Configuracao::getValor('redmine_api_url'));
    }

    public function testNaoAdministradorNaoEditarUrlRedmine()
    {
        // Usuário administrador
        $usuario = User::factory()->create(['admin' => false]);

        // Acessa o painel de configurações
        $componente = Livewire::actingAs($usuario)->test(Pagina::class);

        // Tenta Atualiza a URL
        $componente->set('redmineUrl', 'http://nova-url-redmine.com')->call('salvarConfiguracoesRedmine');

        $this->assertAlertaPerigo(__('messages.permission_denied'), $componente);
    }
}
