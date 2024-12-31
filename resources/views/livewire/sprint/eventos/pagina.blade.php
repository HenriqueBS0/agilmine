<x-slot:navbar>
    <x-sprint.navbar :$sprint />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :$sprint />
</x-slot:sidebar>
<x-main titulo="Eventos">
    <x-slot:acoes>
        @can('isGestor', $sprint)
            <a class="btn btn-primary ms-2" href="{{ route('pagina-sprint-criar-evento', ['sprint' => $sprint]) }}">Criar
                Evento</a>
        @endcan
    </x-slot:acoes>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data - Horario</th>
                <th scope="col" style="width: 100px">Acessar</th>
                @can('isGestor', $sprint)
                    <th scope="col" style="width: 100px">Alterar</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($sprint->eventos()->orderBy('data_hora')->get() as $evento)
                <tr>
                    <td scope="col">{{ $evento->id }}</td>
                    <td scope="col">{{ $evento->getDescricaoTipo() }}</td>
                    <td scope="col">{{ $evento->data_hora->format('d/m/y - H:i') }}</td>
                    <td scope="col">
                        <a class="btn btn-info btn-sm">
                            <span>Acessar</span>
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                    @can('isGestor', $sprint)
                        <td scope="col">
                            <a class="btn btn-warning btn-sm"
                                href="{{ route('pagina-sprint-alterar-evento', ['sprint' => $sprint, 'evento' => $evento]) }}">
                                <span>Alterar</span>
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main>
