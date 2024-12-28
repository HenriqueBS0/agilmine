@props(['tarefa'])

@php
    $url = App\Models\Configuracao::getRedmineUrlApi(true) . '/issues/' . $tarefa->getId();
@endphp

<div class="card mb-3">
    <div class="card-body position-relative">
        <a href="{{ $url }}" target="_blank"
            class="position-absolute top-0 end-0 p-2 text-decoration-none text-muted" title="Ver detalhes">
            <i class="bi bi-box-arrow-up-right"></i>
        </a>
        <h5 class="card-title">{{ $tarefa->getId() }}
        </h5>
        <p class="card-text">{{ $tarefa->getTitulo() }}</p>
        <div class="progress" role="progressbar" aria-label="Progresso da tarefa"
            aria-valuenow="{{ $tarefa->getProporcaoFeita() }}" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated"
                style="width: {{ $tarefa->getProporcaoFeita() }}%">{{ $tarefa->getProporcaoFeita() }}%</div>
        </div>
    </div>
</div>
