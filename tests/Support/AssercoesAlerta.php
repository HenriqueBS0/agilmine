<?php

namespace Tests\Support;

use App\Livewire\Enums\TipoAlerta;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportTesting\Testable;

trait AssercoesAlerta
{
    /**
     * Verifica se um alerta foi armazenado na sessão.
     * E opcionalmente verifica se um evento Livewire foi disparado.
     *
     * @param  string  $tipo
     * @param  string  $mensagem
     * @param  Testable|null  $livewireInstance
     * @return static
     */
    public function assertAlertaSessao(string $tipo, string $mensagem, ?Testable $livewireInstance = null): static
    {
        // Verifica o evento Livewire, se uma instância for fornecida
        if ($livewireInstance) {
            $livewireInstance->assertDispatched('alerta', [
                'tipo' => $tipo,
                'mensagem' => $mensagem,
            ]);
        } else {
            // Verifica a sessão
            $alerta = Session::get('alerta');
            $this->assertNotNull($alerta, 'Nenhum alerta foi armazenado na sessão.');
            $this->assertSame($tipo, $alerta['tipo'], "O tipo do alerta esperado era '{$tipo}', mas foi '{$alerta['tipo']}'.");
            $this->assertSame($mensagem, $alerta['mensagem'], "A mensagem do alerta esperada era '{$mensagem}', mas foi '{$alerta['mensagem']}'.");
        }

        return $this;
    }

    /**
     * Verifica se nenhum alerta foi armazenado na sessão.
     * @return static
     */
    public function assertNenhumAlertaArmazenado(): static
    {
        $this->assertNull(Session::get('alerta'), 'Um alerta foi armazenado na sessão quando não era esperado.');
        return $this;
    }

    /**
     * Verifica se um alerta de sucesso foi armazenado na sessão.
     * @return static
     */
    public function assertAlertaSucesso(string $mensagem, ?Testable $livewireInstance = null): static
    {
        return $this->assertAlertaSessao(TipoAlerta::Sucesso->value, $mensagem, $livewireInstance);
    }

    /**
     * Verifica se um alerta de atenção foi armazenado na sessão.
     * @return static
     */
    public function assertAlertaAtencao(string $mensagem, ?Testable $livewireInstance = null): static
    {
        return $this->assertAlertaSessao(TipoAlerta::Atencao->value, $mensagem, $livewireInstance);
    }

    /**
     * Verifica se um alerta de perigo foi armazenado na sessão.
     * @return static
     */
    public function assertAlertaPerigo(string $mensagem, ?Testable $livewireInstance = null): static
    {
        return $this->assertAlertaSessao(TipoAlerta::Perigo->value, $mensagem, $livewireInstance);
    }

    /**
     * Verifica se um alerta de informação foi armazenado na sessão.
     * @return static
     */
    public function assertAlertaInformacao(string $mensagem, ?Testable $livewireInstance = null): static
    {
        return $this->assertAlertaSessao(TipoAlerta::Informacao->value, $mensagem, $livewireInstance);
    }
}
