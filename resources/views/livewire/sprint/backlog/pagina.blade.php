<x-slot:navbar>
    <x-sprint.navbar :$sprint />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :$sprint />
</x-slot:sidebar>
<x-main titulo="Backlog" wire:ignore @lista-tarefas-atualizada.window="onListaTarefasAtualizada" x-data="pagina">
    <div class="row mb-3">
        <x-sprint.backlog.tarefa :$sprint />
    </div>
    <div class="row flex-grow-1 h-100 overflow-auto">
        <div class="col-6 h-100">
            <x-lista-tarefas id="tarefas-sprint" :tarefas="$tarefasSprint" pesquisa :projeto="$sprint->projeto" selecionavel>
                <x-slot:titulo>Tarefas Sprint</x-slot:titulo>
            </x-lista-tarefas>
        </div>
        <div class="col-6 h-100">
            <x-lista-tarefas id="tarefas-projeto" :tarefas="$tarefasProjeto" pesquisa :projeto="$sprint->projeto" selecionavel>
                <x-slot:titulo>Tarefas Projeto</x-slot:titulo>
            </x-lista-tarefas>
        </div>
    </div>
</x-main>

@script
    <script>
        Alpine.data('pagina', () => {
            return {
                onListaTarefasAtualizada(event) {
                    try {
                        const {
                            id,
                            tarefa,
                            tarefas
                        } = event.detail;

                        if (id === 'tarefas-sprint') {
                            $wire.atualizarTarefasSprint(tarefas.map(t => t.id));
                        } else {
                            $wire.removerTarefa(tarefa.id);
                        }
                    } catch (error) {
                        console.log(event.detail);

                    }
                }
            };
        });
    </script>
@endscript
