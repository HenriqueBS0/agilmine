<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main class="container" titulo="Configurações">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Métricas</h5>
                    <div class="row">
                        <div class="col">
                            <x-input-switch id="metrica-membro" label="Membro" wire:model="form.metrica_usuario" />
                        </div>
                        <div class="col">
                            <x-input-switch id="metrica-horas" label="Horas" wire:model="form.metrica_horas" />
                        </div>
                        <div class="col">
                            <x-input-switch id="metrica-story-points" label="Story Points"
                                wire:model="form.metrica_story_points" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cores Sprint</h5>
                    <div class="row">
                        <div class="col">
                            <x-input id="cor-sprint-andamento" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_sprint_andamento">
                                <x-slot:label>Em Andamento</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-sprint-atrasada" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_sprint_atrasada">
                                <x-slot:label>Atrasada</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-sprint-concluida" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_sprint_concluida">
                                <x-slot:label>Concluída</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-sprint-cancelada" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_sprint_cancelada">
                                <x-slot:label>Cancelada</x-slot:label>
                            </x-input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cores Release</h5>
                    <div class="row">
                        <div class="col">
                            <x-input id="cor-release-andamento" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_release_andamento">
                                <x-slot:label>Andamento</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-release-atrasada" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_release_atrasada">
                                <x-slot:label>Atrasada</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-release-concluida" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_release_concluida">
                                <x-slot:label>Concluída</x-slot:label>
                            </x-input>
                        </div>
                        <div class="col">
                            <x-input id="cor-release-cancelada" container-class="mb-3" type="color"
                                class="form-control-color" wire:model="form.cor_release_cancelada">
                                <x-slot:label>Cancelada</x-slot:label>
                            </x-input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botão Salvar -->
        <div class="col-12 text-end mt-3">
            <button class="btn btn-primary" wire:click="save">
                Salvar Configurações
            </button>
        </div>
    </div>
</x-main>
