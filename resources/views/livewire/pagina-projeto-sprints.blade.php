<x-slot:navbar>
    <livewire:pagina-projeto-navbar :$projeto atual="Sprints" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-projeto-sidebar :$projeto atual="Sprints" />
</x-slot:sidebar>
<main class="container mt-3">
    <div class="row mb-3">
        <div class="d-flex justify-content-between">
            <h3>Sprints</h3>
            <div class="acoes">
                <button class="btn btn-outline-primary" data-bs-toggle="collapse" href="#container-filtros" role="button"
                    aria-expanded="false" aria-controls="container-filtros"><i class="bi bi-filter"></i>
                    Filtros</button>
                <a href="{{ route('pagina-projeto-criar-sprint', ['projetoId' => $projeto->getId()]) }}"
                    class="btn btn-primary"><i class="bi bi-plus-lg"></i> Criar</a>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="collapse" id="container-filtros">
            <div class="card card-body">
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when
                the user activates the relevant trigger.
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        @foreach ($sprints as $sprint)
            <div class="col-12">
                <x-pagina-projeto.sprint-item :$sprint wire:key="{{ $sprint->id }}" />
            </div>
        @endforeach
    </div>
</main>
