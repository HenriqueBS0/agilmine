<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de Inínio</th>
            <th scope="col">Data de Fim</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($releases as $release)
            <tr>
                <td scope="col">
                    <a href="{{ route('pagina-sprint-report', ['sprint' => $release]) }}">
                        {{ $release->serial }}
                    </a>
                </td>
                <td scope="col">{{ $release->nome }}</td>
                <td scope="col">{{ $release->data_inicio->format('d/m/Y') }}</td>
                <td scope="col">{{ $release->data_fim->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
