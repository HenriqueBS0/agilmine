<x-slot:navbar>
    <livewire:pagina-sprint-navbar :$projeto :$sprint atual="{{ $sprint->nome }}" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-sprint-sidebar :$projeto :$sprint atual="Backlog" />
</x-slot:sidebar>
<main class="d-flex flex-column h-100 container" x-data="paginaBacklog" @movida-tarefa="onMovidaTarefa($event)">
    <div class="row mb-3 mt-3">
        <h3>Backlog</h3>
    </div>
    <div class="row mb-3">
        <livewire:pagina-sprint-backlog-detalhamento-tarefa :prioridades=$tarefaPrioridade :tipos=$tarefaTipo
            :status-list=$tarefaStatus :membros=$membrosProjeto />
    </div>
    <div class="row mb-3 d-flex h-100 overflow-y-auto">
        <livewire:pagina-sprint-backlog-lista-tarefas titulo="Tarefas da Sprint" identificador="tarefasSprint"
            containerClasses="w-50" :tarefas=$tarefasSprint wire:key="tarefasSprint" />
        <livewire:pagina-sprint-backlog-lista-tarefas titulo="Tarefas do Projeto" containerClasses="w-50"
            :tarefas=$tarefasProjeto wire:key="tarefasProjeto" identificador="tarefasProjeto" />
    </div>
</main>

@script
    <script>
        Alpine.data('paginaBacklog', () => {
            return {
                onMovidaTarefa(event) {
                    const {
                        tarefaId,
                        lista
                    } = event.detail;

                    if (lista == 'tarefasSprint') {
                        $wire.adicionarTarefaSprint(tarefaId);
                    } else {
                        $wire.removerTarefaSprint(tarefaId);
                    }
                }
            };
        });
    </script>
@endscript
