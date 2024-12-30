<x-slot:navbar>
    <x-sprint.navbar :$sprint />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :$sprint />
</x-slot:sidebar>
<x-main titulo="Eventos">
    <x-slot:acoes>
        @can('isGestor', $sprint)
            {{--  --}}
            <a class="btn btn-primary ms-2" href="{{ route('pagina-sprint-criar-evento', ['sprint' => $sprint]) }}">Criar
                Evento</a>
        @endcan
    </x-slot:acoes>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Perfis</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</x-main>
