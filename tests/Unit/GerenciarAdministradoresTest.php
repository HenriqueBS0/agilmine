<?php

namespace Tests\Unit;

use App\Livewire\Enums\TipoAlerta;
use App\Livewire\Home\Usuarios\Pagina;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GerenciarAdministradoresTest extends TestCase
{

    use RefreshDatabase;

    public function testAdministradorConsegueTornarOutroUsuarioAdministrador()
    {
        $admin = User::factory()->create(['admin' => true]);
        $user = User::factory()->create(['admin' => false]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $user->id, true);

        $this->assertTrue($user->fresh()->admin);
    }

    public function testAdministradorRemovePermissoesDeOutroAdministrador()
    {
        $admin = User::factory()->create(['admin' => true]);
        $outroAdmin = User::factory()->create(['admin' => true]);

        Livewire::actingAs($admin)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $outroAdmin->id, false);

        $this->assertFalse($outroAdmin->fresh()->admin);
    }

    public function testApenasAdministradoresPodemGerenciarPermissoes()
    {
        $naoAdministrador = User::factory()->create(['admin' => false]);
        $user = User::factory()->create();

        Livewire::actingAs($naoAdministrador)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $user->id, true)
            ->assertDispatched('alerta', [
                "tipo" => TipoAlerta::Perigo->value,
                "mensagem" => __('messages.permission_denied')
            ]);

        $this->assertFalse($user->fresh()->admin);
    }

    public function testAdminstradorNaoPodeGerenciarPropriasPermissoes()
    {
        $user = User::factory()->create(['admin' => true]);

        Livewire::actingAs($user)
            ->test(Pagina::class)
            ->call('atualizarAdmin', $user->id, false)
            ->assertDispatched('alerta', [
                "tipo" => TipoAlerta::Perigo->value,
                "mensagem" => __('messages.self_permission_change')
            ]);

        $this->assertTrue($user->fresh()->admin);
    }

    public function testUsuariosSemPermissaoNaoAcessamFuncionalidadesDeAdministradores()
    {
        $user = User::factory()->create(['admin' => false]);

        $this->actingAs($user);

        $response = $this->get(route('pagina-usuarios'));
        $response->assertForbidden();
    }
}
