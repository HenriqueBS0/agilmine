<?php

namespace App\Livewire\Home\Usuarios;

use App\Livewire\Traits\DisparadorAlerta;
use App\Livewire\Traits\DisparadorModal;
use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;
    use DisparadorModal;

    public $usuarios;
    public ?User $usuarioSelecionado;

    public ?string $novaSenha;

    public function mount()
    {
        $this->usuarios = User::all();
    }

    public function render()
    {
        return view('livewire.home.usuarios.pagina');
    }

    public function atualizarAdmin($usuarioId, $admin, UserService $userService)
    {
        $usuario = User::findOrFail($usuarioId);

        try {
            $userService->atualizarAdmin($usuario, $admin);
            $this->usuarios = User::all();
        } catch (\Exception $e) {
            $this->alertaPerigo($e->getMessage());
        }
    }

    public function atualizarHabilitado($usuarioId, $habilitado, UserService $userService)
    {
        $usuario = User::findOrFail($usuarioId);

        try {
            $userService->atualizarHabilitado($usuario, $habilitado);
            $this->usuarios = User::all();
        } catch (\Exception $e) {
            $this->alertaPerigo($e->getMessage());
        }
    }

    public function confirmarGeracaoSenha($usuarioId)
    {
        $this->usuarioSelecionado = User::findOrFail($usuarioId);
        $this->abrirModal('confirmar-geracao-senha');
    }

    public function gerarNovaSenha(UserService $userService)
    {
        if (!$this->usuarioSelecionado) {
            $this->alertaPerigo('Nenhum usuário selecionado.');
            return;
        }

        if ($this->usuarioSelecionado->email === 'admin@email.com') {
            return;
        }

        try {
            $this->novaSenha = $userService->gerarNovaSenha($this->usuarioSelecionado);
            $this->usuarios = User::all();

            $this->abrirModal('menasgem-informacao-senha');
        } catch (\Exception $e) {
            $this->alertaPerigo($e->getMessage());
        } finally {
            $this->fecharModal('confirmar-geracao-senha');
        }
    }
}
