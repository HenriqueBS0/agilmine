<?php

namespace App\Livewire\Home\Usuarios;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    public $usuarios;

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
}
