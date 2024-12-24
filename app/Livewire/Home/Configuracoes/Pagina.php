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

    public function mount()
    {
        $this->redmineUrl = Configuracao::getValor(Configuracao::KEY_REDMINE_URL_API);
    }

    public function render()
    {
        return view('livewire.home.configuracoes.pagina');
    }

    public function salvarConfiguracoesRedmine(ConfiguracaoService $service)
    {
        try {
            $service->atualizarUrlRedmine($this->redmineUrl);
            $this->alertaSucesso(__('messages.config_saved_successfully'));
        } catch (\Throwable $th) {
            $this->alertaPerigo($th->getMessage());
        }
    }
}
