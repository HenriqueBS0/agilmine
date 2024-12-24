<x-slot:navbar>
    <x-home.navbar />
</x-slot:navbar>
<x-slot:sidebar>
    <x-home.sidebar />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main class="container">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Redmine</h5>
                <x-input id='url' class="mb-3" wire:model="redmineUrl">
                    <x-slot:label>URL</x-slot:label>
                </x-input>
                <button type="button" class="btn btn-primary" wire:click="salvarConfiguracoesRedmine">Salvar</button>
            </div>
        </div>
    </div>
</x-main>
