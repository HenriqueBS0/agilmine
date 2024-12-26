@props(['projeto'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-body">
        <h5 class="card-title">{{ $projeto->nome }}</h5>
        <p class="card-text">{{ $projeto->descricao }}</p>
    </div>
    <div class="card-footer">
        <a href="#" class="btn btn-primary">Acessar</a>
        @can('isGestor', $projeto)
            <button {{ $arquivar->attributes->merge(['class' => 'btn btn-secondary']) }}>Arquivar</button>
        @endcan
    </div>
</div>
