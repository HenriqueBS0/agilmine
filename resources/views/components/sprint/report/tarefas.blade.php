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
                    <th scope="col">Status</th>
                    <th scope="col">Progresso</th>
                    <th scope="col" style="min-width: 130px;">Data Prevista</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $indice => $tarefa)
                    <tr>
                        <x-sprint.report.tarefas-cedula :$tarefa>{{ $indice + 1 }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula :$tarefa>
                            <a href="{{ $linkTarefa($tarefa) }}" target="_black" @class([
                                'badge text-bg-primary' =>
                                    $tarefa->getDesenvolvedor()?->getId() ===
                                    auth()->user()->id_usuario_redmine,
                            ])>
                                {{ $tarefa->getId() }}
                            </a>
                        </x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getTitulo() }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getDescritor()?->getNome() }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getDesenvolvedor()?->getNome() }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getTestador()?->getNome() }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getStatus()?->getNome() }}</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getProporcaoFeita() }}%</x-sprint.report.tarefas-cedula>
                        <x-sprint.report.tarefas-cedula
                            :$tarefa>{{ $tarefa->getDataConclusaoEstimada()?->format('d/m/Y') }}</x-sprint.report.tarefas-cedula>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-report.secao>
</div>
