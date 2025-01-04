<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de Inínio</th>
            <th scope="col">Data de Fim</th>
            <th scope="col">Gera Release</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sprints as $sprint)
            <tr>
                <td scope="col">
                    <a href="{{ route('pagina-sprint-report', ['sprint' => $sprint]) }}">
                        {{ $sprint->serial }}
                    </a>
                </td>
                <td scope="col">{{ $sprint->nome }}</td>
                <td scope="col">{{ $sprint->data_inicio->format('d/m/Y') }}</td>
                <td scope="col">{{ $sprint->data_fim->format('d/m/Y') }}</td>
                <td scope="col">
                    {{ $sprint->gera_release ? 'Sim' : 'Não' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
