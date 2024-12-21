<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste 1: Verificar se a conta padrão do administrador é criada automaticamente ao rodar os seeders do sistema.
     */
    public function testVerificarSeContaAdminEObrigatoriamenteCriada()
    {
        // Rodar os seeders
        $this->artisan('db:seed');

        // Verificar se o usuário "Rodrigo Curvello" foi criado como admin
        $admin = User::where('email', 'rodrigo.curvello@ifc.edu.br')->first();

        $this->assertNotNull($admin, 'A conta do administrador não foi criada.');
        $this->assertTrue($admin->admin, 'A conta criada não tem permissão de administrador.');
    }

    /**
     * Teste 2: Confirmar que o administrador consegue acessar o sistema usando as credenciais padrão após a inicialização.
     */
    public function testConfirmarQueAdminConsegueLogarComCredenciaisPadrao()
    {
        // Rodar os seeders
        $this->artisan('db:seed');

        // Tentar autenticar o administrador com as credenciais padrão
        $response = $this->post('/login', [
            'email' => 'rodrigo.curvello@ifc.edu.br',
            'password' => 'rodrigo12345',
        ]);

        // Verificar se a autenticação foi bem-sucedida
        $response->assertRedirect('/projetos'); // Ajuste o redirecionamento conforme sua rota pós-login
        $this->assertAuthenticatedAs(User::where('email', 'rodrigo.curvello@ifc.edu.br')->first());
    }
}
