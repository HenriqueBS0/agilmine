<?php

namespace Tests\Feature\Home\Usuarios;

use App\Livewire\Home\Usuarios\Pagina;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GerenciarUsuariosTest extends TestCase
{

    use RefreshDatabase;

    public function testAdminPodeVisualizarTodosUsuarios()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuarios = User::factory()->count(5)->create();

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class);

        foreach ($usuarios as $usuario) {
            $componente->assertSee($usuario->name);
            $componente->assertSee($usuario->email);
        }
    }

    public function testAdminPodeHabilitarUsuario()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create(['habilitado' => false]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarHabilitado', $usuario->id, true);

        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'habilitado' => true]);
    }

    public function testAdminPodeDesabilitarUsuario()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create(['habilitado' => true]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarHabilitado', $usuario->id, false);

        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'habilitado' => false]);
    }

    public function testSomenteAdministradoresPodemGerenciarHabilitacao()
    {
        $naoAdministrador = User::factory()->create(['admin' => false]);
        $usuario = User::factory()->create();

        $componente = Livewire::actingAs($naoAdministrador)
            ->test(Pagina::class)
            ->call('atualizarHabilitado', $usuario->id, true);

        $this->assertAlertaPerigo(__('messages.permission_denied'), $componente);

        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'habilitado' => true]);
    }

    public function testAdminNaoPodeDesabilitarPropriaConta()
    {
        $admin = User::factory()->create(['admin' => true]);

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarHabilitado', $admin->id, false);

        $this->assertAlertaPerigo(__('messages.self_account_disable'), $componente);

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'habilitado' => true]);
    }

    public function testAdminPodeTornarOutroUsuarioAdministrador()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create(['admin' => false]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $usuario->id, true);

        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'admin' => true]);
    }

    public function testAdminPodeRemoverPermissaoDeOutroAdministrador()
    {
        $admin = User::factory()->create(['admin' => true]);
        $outroAdmin = User::factory()->create(['admin' => true]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $outroAdmin->id, false);

        $this->assertDatabaseHas('users', ['id' => $outroAdmin->id, 'admin' => false]);
    }

    public function testSomenteAdministradoresPodemGerenciarPermissoes()
    {
        $naoAdministrador = User::factory()->create(['admin' => false]);
        $usuario = User::factory()->create();

        $componente = Livewire::actingAs($naoAdministrador)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $usuario->id, true);

        $this->assertAlertaPerigo(__('messages.permission_denied'), $componente);
        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'admin' => false]);
    }

    public function testAdminNaoPodeAlterarPropriasPermissoes()
    {
        $admin = User::factory()->create(['admin' => true]);

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $admin->id, false);

        $this->assertAlertaPerigo(__('messages.self_permission_change'), $componente);

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'admin' => true]);
    }

    public function testUsuariosSemPermissaoNaoPodemAcessarFuncionalidadesDeAdministradores()
    {
        $usuario = User::factory()->create(['admin' => false]);

        $this->actingAs($usuario);

        $response = $this->get(route('pagina-usuarios'));
        $response->assertForbidden();
    }

    public function testAdminPodeAbrirModalDeConfirmacaoParaGerarSenha()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create();

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('confirmarGeracaoSenha', $usuario->id);

        $this->assertAbrirModal('confirmar-geracao-senha', $componente);
        $componente->assertSet('usuarioSelecionado.id', $usuario->id);
    }

    public function testAdminPodeGerarNovaSenhaParaUsuario()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create();

        $senhaAntiga = $usuario->password;

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->set('usuarioSelecionado', $usuario)
            ->call('gerarNovaSenha');

        $this->assertAbrirModal('menasgem-informacao-senha', $componente);

        $componente->assertSee($componente->get('novaSenha'));

        $this->assertNotEquals($senhaAntiga, $usuario->fresh()->password, 'A senha antiga deve ser diferente da atual');
    }

    public function testNaoAdminNaoPodeGerarNovaSenhaParaUsuario()
    {
        $admin = User::factory()->create(['admin' => false]);
        $usuario = User::factory()->create();

        $componente = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->set('usuarioSelecionado', $usuario)
            ->call('gerarNovaSenha');

        $this->assertAlertaPerigo(__('messages.permission_denied'), $componente);
    }

    public function testUsuarioPodeAcessarSistemaComNovaSenha()
    {
        $admin = User::factory()->create(['admin' => true]);
        $usuario = User::factory()->create();

        $component = Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->set('usuarioSelecionado', $usuario)
            ->call('gerarNovaSenha');

        $novaSenha = $component->get('novaSenha');

        // Tenta fazer login com a nova senha
        $response = $this->post(route('login'), [
            'email' => $usuario->email,
            'password' => $novaSenha,
        ]);

        $response->assertRedirect(route('pagina-projetos'));
    }
}
