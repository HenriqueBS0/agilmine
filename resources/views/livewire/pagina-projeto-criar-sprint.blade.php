<x-slot:navbar>
    <livewire:pagina-projeto-navbar :$projeto atual="Sprints" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-projeto-sidebar :$projeto atual="Sprints" />
</x-slot:sidebar>
<main class="container mt-3">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3>Criar Sprint</h3>
            </div>
        </div>
        <div class="row">
            <livewire:formulario-sprint :$sprint save="store" :leitura=false />
        </div>
    </div>
</main>
