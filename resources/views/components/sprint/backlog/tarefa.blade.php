<div {{ $attributes }} @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    tarefa: null,
    hasTarefa() {
        return !!this.tarefa;
    },
    onTarefaSelecionada(event) {
        this.tarefa = event.detail.tarefa;
    }
}">
    <div class="card">
        <div class="card-header">
            <x-tab-nav class="card-header-tabs">
                <x-tab-nav-item id='identificacao' active>Identificação</x-tab-nav-item>
                <x-tab-nav-item id='acompanhamento'>Acompanhamento</x-tab-nav-item>
                <x-tab-nav-item id='membros'>Membros</x-tab-nav-item>
                <x-tab-nav-item id='descricao'>Descrição</x-tab-nav-item>
            </x-tab-nav>
        </div>
        <x-tab-content class="card-body">
            <x-tab-panel id='identificacao' active>
                <x-sprint.backlog.tarefa-identificacao />
            </x-tab-panel>
            <x-tab-panel id='acompanhamento'>
                <x-sprint.backlog.tarefa-acompanhamento />
            </x-tab-panel>
            <x-tab-panel id='membros'>
                <x-sprint.backlog.tarefa-membros :$sprint />
            </x-tab-panel>
            <x-tab-panel id='descricao'>
                <x-sprint.backlog.tarefa-descricao />
            </x-tab-panel>
        </x-tab-content>
    </div>
</div>
