<x-slot name="navbar">
    <livewire:navbar :$navbarBreadCrumbItens></livewire:navbar>
</x-slot>

<div class="container">
    <div class="row">
        <h2>Dashboard: {{ $sprint->nome }} ({{ (new DateTime($sprint->data_inicio))->format('d/m/Y') }} -
            {{ (new DateTime($sprint->data_fim))->format('d/m/Y') }})</h2>
        <div class="row">
            <div class="col-6">
                <canvas id="burn-down"></canvas>
            </div>
            <div class="col-6">
                <canvas id="burn-up"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Assunto</th>
                    <th scope="col">Status</th>
                    <th scope="col">Prioridade</th>
                    <th scope="col">Data Conclusão</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $tarefa)
                    <tr>
                        <td scope="col">{{ $tarefa->getId() }}</td>
                        <td scope="col">{{ $tarefa->getAssunto() }}</td>
                        <td scope="col">{{ $tarefa->getStatus()->getNome() }}</td>
                        <td scope="col">{{ $tarefa->getPrioridade()->getNome() }}</td>
                        <td scope="col">
                            {{ $tarefa->getDataConclusao() ? $tarefa->getDataConclusao()->format('d/m/Y') : null }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
        new Chart(document.getElementById('burn-down'), $wire.configuracaoBurnDown);
        new Chart(document.getElementById('burn-up'), $wire.configuracaoBurnUp);
    </script>
@endscript
