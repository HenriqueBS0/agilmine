<div class="row g-2 mb-2">
    <x-report.secao titulo="Tarefas Sprint" :no-break="false">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Count</th>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descritor</th>
                    <th scope="col">Desenvolvedor</th>
                    <th scope="col">Testador</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $indice => $tarefa)
                    <tr>
                        <td scope="col">{{ $indice + 1 }}</td>
                        <td scope="col">
                            <a href="{{ $linkTarefa($tarefa) }}" target="_black">
                                {{ $tarefa->getId() }}
                            </a>
                        </td>
                        <td scope="col">{{ $tarefa->getTitulo() }}</td>
                        <td scope="col">{{ $tarefa->getDescritor()?->getNome() }}</td>
                        <td scope="col">{{ $tarefa->getDesenvolvedor()?->getNome() }}</td>
                        <td scope="col">{{ $tarefa->getTestador()?->getNome() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-report.secao>
</div>
