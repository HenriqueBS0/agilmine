<?php

namespace Tests\Feature\Home\Usuarios;

use App\Livewire\Enums\TipoAlerta;
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
}
