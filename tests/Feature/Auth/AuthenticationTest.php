<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testTelaDeLoginPodeSerRenderizada(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testUsuariosPodemAutenticarUsandoATelaDeLogin(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function testUsuariosHabilitadosPodemAutenticarUsandoATelaDeLogin(): void
    {
        $user = User::factory()->create(['habilitado' => true]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function testUsuariosNaoHabilitadosNaoPodemAutenticarUsandoATelaDeLogin(): void
    {
        $user = User::factory()->create(['habilitado' => false]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAlertaAtencao(__('messages.account_disabled'));
        $this->assertGuest();
    }

    public function testUsuariosNaoPodemAutenticarComSenhaInvalida(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function testUsuariosPodemFazerLogout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
