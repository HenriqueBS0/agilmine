<x-slot:navbar>
    <x-navbar>
        <x-slot:breadcrumb>
            <x-navbar.breadcrumb>
                <x-navbar.breadcrumb.item-atual>Projetos</x-navbar.breadcrumb.item-atual>
            </x-navbar.breadcrumb>
        </x-slot:breadcrumb>
    </x-navbar>
</x-slot:navbar>
<x-slot:sidebar>
    <x-sidebar>
        <x-sidebar.item-atual>Projetos</x-sidebar.item-atual>
    </x-sidebar>
</x-slot:sidebar>
<main class="container mt-3">
    <div class="row mb-3">
        <h3>Meus Projetos</h3>
    </div>
    <div class="col-12 mb-3">
        <div class="row gap-3">
            @foreach ($projetos as $projeto)
                <div class="col-12">
                    <x-pagina-projetos.projeto titulo='{{ $projeto->getNome() }}' :key="$projeto->getId()"
                        href="{{ route('pagina-projeto-sprints', ['projetoId' => $projeto->getId()]) }}">
                        {{ $projeto->getDescricao() }}
                    </x-pagina-projetos.projeto>
                </div>
            @endforeach
        </div>
    </div>
</main>
