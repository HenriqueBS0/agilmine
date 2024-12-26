@props(['projeto'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-body">
        <h5 class="card-title">{{ $projeto->nome }}</h5>
        <p class="card-text">{{ $projeto->descricao }}</p>
    </div>
    @can('isGestor', $projeto)
        <div class="card-footer">
            <button {{ $desarquivar->attributes->merge(['class' => 'btn btn-secondary']) }}>Desarquivar</button>
        </div>
    @endcan
</div>
