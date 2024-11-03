<div class="d-flex flex-column h-100 {{ $containerClasses }}" x-data="{
    identificador: $wire.identificador,
    pesquisa: '',
    tarefas: $wire.tarefas,
    movendoTarefa: false,
    tarefaSelecionada: null,

    onclick(event, tarefa) {
        $dispatch('click-tarefa', {
            lista: this,
            tarefaId: tarefa.id
        });
    },

    onClickTarefa(event) {
        this.setTarefaSelecionada(this.getTarefaFromId(event.detail.tarefaId));
    },

    getTarefaFromId(tarefaId) {
        return this.tarefas.find(tarefa => tarefa.id == tarefaId);
    },

    ondragstart(event, tarefaId) {
        const tarefa = this.tarefas.find(tarefa => tarefa.id == tarefaId);
        event.dataTransfer.setData('text/tarefa', JSON.stringify({
            tarefa: tarefa,
            tarefaSelecionada: this.getTarefaSelecionada()
        }));
        this.movendoTarefa = true;
    },

    ondragend(event, tarefaId) {
        this.movendoTarefa = false;
        if (event.dataTransfer.dropEffect == 'none') return;
        this.tarefas = this.tarefas.filter(tarefa => tarefa.id != tarefaId);
    },

    ondragenter(event) {
        if (!event.dataTransfer.types.includes('text/tarefa') || this.movendoTarefa) return;
        event.preventDefault();
    },

    ondragover(event) {
        if (!event.dataTransfer.types.includes('text/tarefa') || this.movendoTarefa) return;
        event.preventDefault();
        event.currentTarget.classList.add('border-primary-subtle', 'bg-primary-subtle');
    },

    ondragleave(event) {
        event.currentTarget.classList.remove('border-primary-subtle', 'bg-primary-subtle');
    },

    ondrop(event) {
        event.currentTarget.classList.remove('border-primary-subtle', 'bg-primary-subtle');
        const {
            tarefa,
            tarefaSelecionada
        } = JSON.parse(event.dataTransfer.getData('text/tarefa'));

        if (tarefaSelecionada) this.setTarefaSelecionada(tarefaSelecionada);

        this.tarefas = [...this.tarefas, tarefa].sort((a, b) => a.id - b.id);

        $dispatch('movida-tarefa', {
            lista: this.identificador,
            tarefaId: tarefa.id
        });

        event.preventDefault();
    },

    setTarefaSelecionada(tarefa) {
        if (this.tarefaSelecionada != tarefa) {
            this.tarefaSelecionada = tarefa;

            $dispatch('tarefa-selecionada', {
                tarefa
            });
        }
    },

    getTarefaSelecionada() {
        return this.tarefaSelecionada;
    },

    get tarefasFiltradas() {
        return this.tarefas.filter(tarefa =>
            `${tarefa.id} - ${tarefa.titulo}`.toLowerCase().includes(this.pesquisa.toLowerCase())
        );
    },
}">
    <h5>{{ $titulo }}</h5>
    <div class="mb-2">
        <input class="form-control" type="text" placeholder="Pesquisar..." x-model='pesquisa'>
    </div>
    <div class="list-group h-100 overflow-y-scroll bg-light border" @dragenter="ondragenter($event)"
        @dragover="ondragover($event)" @dragleave="ondragleave($event)" @drop="ondrop($event)"
        @click-tarefa.window="onClickTarefa($event)">
        <template x-for="tarefa in tarefasFiltradas" :key="tarefa.id">
            <button type="button"
                :class="{
                    'active': tarefaSelecionada && tarefaSelecionada.id === tarefa.id,
                    'list-group-item list-group-item-action border-0 rounded-0 border-bottom': true
                }"
                x-text="tarefa.id + ' - ' + tarefa.titulo" draggable="true" @dragstart="ondragstart($event, tarefa.id)"
                @dragend="ondragend($event, tarefa.id)" @click="onclick($event, tarefa)"></button>
        </template>
    </div>
</div>
