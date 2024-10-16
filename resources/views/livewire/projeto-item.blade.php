<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $projeto->getNome() }}</h4>
        <p class="card-text">{{ $projeto->getDescricao() }}</p>
        <a href="{{ route('projetos-item', ['id' => $projeto->getId()]) }}" class="btn btn-primary">Acessar</a>
    </div>
</div>
