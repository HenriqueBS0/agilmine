<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-main titulo="Sprints">
    @can('isGestor', $projeto)
        <x-slot:acoes>
            <a class="btn btn-primary" href="{{ route('pagina-projeto-criar-sprint', ['projeto' => $projeto]) }}">Criar
                Sprint</a>
        </x-slot:acoes>
    @endcan
    <div class="row g-3">
        @foreach ($sprints as $sprint)
        @endforeach
    </div>
</x-main>
