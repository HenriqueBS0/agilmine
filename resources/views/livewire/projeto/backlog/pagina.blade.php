<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-main titulo="Backlog" @lista-tarefas-atualizada.window="$wire.atualizarBacklog($event.detail.tarefas.map(t=>t.id))">
    <div class="row flex-grow-1 h-100 overflow-auto">
        <div class="col h-100">
            <x-lista-tarefas id="tarefas-backlog" :tarefas="$tarefas" pesquisa :draggable="Gate::allows('isGestor', $projeto)" />
        </div>
    </div>
</x-main>
