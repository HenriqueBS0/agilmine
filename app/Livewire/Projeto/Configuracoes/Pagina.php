<?php

namespace App\Livewire\Projeto\Configuracoes;

use App\Livewire\Forms\ProjetoConfiguracaoForm;
use App\Livewire\Traits\DisparadorAlerta;
use App\Models\Projeto;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Pagina extends Component
{

    use DisparadorAlerta;

    #[Locked]
    public Projeto $projeto;

    public ProjetoConfiguracaoForm $form;

    public function mount(Projeto $projeto)
    {
        $this->projeto = $projeto;
        $this->form->setProjetoConfiguracao($projeto->configuracao);
    }

    public function save()
    {
        $this->authorize('isGestor', $this->projeto);
        $this->form->update();
        $this->alertaSucesso(__('messages.config_saved_successfully'));
    }

    public function render()
    {
        return view('livewire.projeto.configuracoes.pagina');
    }
}
