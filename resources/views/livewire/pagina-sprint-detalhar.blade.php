<x-slot:navbar>
    <livewire:pagina-sprint-navbar :$projeto :$sprint atual="{{ $sprint->nome }}" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-sprint-sidebar :$projeto :$sprint atual="Detalhar" />
</x-slot:sidebar>
<main class="mt-3">
    <livewire:pagina-sprint-modal-excluir :$sprint id='modal-excluir' />
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3>{{ $sprint->serial }} - {{ $sprint->nome }}</h3>
            </div>
        </div>
        <div class="row mb-3">
            <livewire:formulario-sprint :$sprint save="store" :preencher=true :leitura=true />
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('pagina-sprint-alterar', ['projetoId' => $sprint->project_id, 'sprint' => $sprint->id]) }}"
                    class="btn btn-warning" type="submit">Alterar</a>
                <button class="btn btn-danger" data-bs-target="#modal-excluir" data-bs-toggle="modal">Excluir</button>
            </div>
        </div>
    </div>
</main>
