@php
    $corTema = $sprint->gera_release ? 'destaque' : 'primary';
@endphp

<div class="card">
    <div @class(['card-header', "text-bg-$corTema" => !$sprint->isConcluida()]) @style([
        "background-color: var(--bs-$corTema-bg-subtle)" => $sprint->isConcluida(),
        "color: var(--bs-$corTema-text-emphasis)" => $sprint->isConcluida(),
    ])>
        {{ $sprint->gera_release ? 'Release' : 'Sprint' }}: {{ $sprint->isConcluida() ? 'Concluída' : 'Em andamento' }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $sprint->serial }} - {{ $sprint->nome }}</h5>
        <p class="card-text"><strong>Período:</strong> {{ $sprint->data_inicio->format('d/m/Y') }} -
            {{ $sprint->data_fim->format('d/m/Y') }}</p>
        <p class="card-text">{{ $sprint->resumo }}</p>
    </div>
    <div class="card-body">
        <a href="{{ route('pagina-sprint-report', ['projetoId' => $sprint->project_id, 'sprint' => $sprint->id]) }}"
            @class(['btn', "btn-$corTema" => !$sprint->isConcluida()]) @style([
                "background-color: var(--bs-$corTema-bg-subtle)" => $sprint->isConcluida(),
                "color: var(--bs-$corTema-text-emphasis)" => $sprint->isConcluida(),
            ])>
            Acessar
        </a>
    </div>
</div>
