<x-slot:navbar>
    <livewire:pagina-sprint-navbar :$projeto :$sprint atual="{{ $sprint->nome }}" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-sprint-sidebar :$projeto :$sprint atual="Detalhar" />
</x-slot:sidebar>
<main class="container mt-3">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3>Alterar: {{ $sprint->serial }} - {{ $sprint->nome }}</h3>
            </div>
        </div>
        <div class="row mb-3">
            <livewire:formulario-sprint :$sprint save="update" :preencher=true />
        </div>
    </div>
</main>
