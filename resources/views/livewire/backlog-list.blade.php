<div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Assunto</th>
                <th scope="col">Status</th>
                <th scope="col">Prioridade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa)
                <tr>
                    <td scope="col">{{ $tarefa->getId() }}</td>
                    <td scope="col">{{ $tarefa->getAssunto() }}</td>
                    <td scope="col">{{ $tarefa->getStatus()->getNome() }}</td>
                    <td scope="col">{{ $tarefa->getPrioridade()->getNome() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <livewire:paginacao :$paginacao />
</div>
