<?php

namespace App\Livewire\Home\Configuracoes;

use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Configuracao;
use App\Services\ConfiguracaoService;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;
    public $redmineUrl = '';

    public $redmineAdmKey = '';

    // public $redmineKey = 

    public function mount()
    {
        $this->redmineUrl = Configuracao::getRedmineUrlApi();
        $this->redmineAdmKey = Configuracao::getRedmineAdmKey();
    }

    public function render()
    {
        return view('livewire.home.configuracoes.pagina');
    }

    public function salvarConfiguracoesRedmine(ConfiguracaoService $service)
    {
        try {
            $service->atualizarUrlRedmine($this->redmineUrl);
            $service->atualizarKeyAdmRedmine($this->redmineAdmKey);
            $this->alertaSucesso(__('messages.config_saved_successfully'));
        } catch (\Throwable $th) {
            $this->alertaPerigo($th->getMessage());
        }
    }
}
