@props(['id', 'tarefas' => [], 'draggable' => false, 'selecionavel' => false, 'pesquisa' => false])

@php
    $urlBase = App\Models\Configuracao::getRedmineUrlApi(true) . '/issues/';
@endphp


<div id="{{ $id }}" class="h-100 d-flex flex-column" @tarefa-selecionada.window="onTarefaSelecionada($event)"
    x-data="{
        tarefas: {{ Js::from(array_map(fn($tarefa) => $tarefa->toArray(), $tarefas)) }},
        search: '',
        dragging: null,
        tarefaSobreposta: null,
        tarefaSelecionada: null,
        filteredTarefas() {
            return this.tarefas.filter(tarefa =>
                (tarefa.id + tarefa.titulo).toLowerCase().includes(this.search.toLowerCase())
            );
        },
        onDragStart(event, tarefa) {
            this.dragging = tarefa;
            event.dataTransfer.setData('text/tarefa', JSON.stringify(tarefa));
        },
        onDragEnd(event) {
            if (event.dataTransfer.dropEffect == 'none' || this.dragging == null) return;
            this.tarefas = this.tarefas.filter(t => t.id != this.dragging.id);
            this.dragging = null;
        },
        onDragEnter(event, tarefa = null) {
            if (event.fromElement?.classList.contains('list-group-item') && tarefa) {
                this.tarefaSobreposta = tarefa;
            }
        },
        onDragOver(event) {
            event.preventDefault();
        },
        onDragLeave(event, tarefa = null) {
            if (event.fromElement?.classList.contains('list-group-item') && tarefa && this.tarefaSobreposta && (tarefa.id === this.tarefaSobreposta.id)) {
                this.tarefaSobreposta = null;
            }
        },
        onDragDrop(event) {
            const tarefa = JSON.parse(event.dataTransfer.getData('text/tarefa'));
    
            const tarefasAntes = this.tarefas.map(t => t.id);
    
            this.dragging ?
                this.dropPropriaLista(tarefa) :
                this.dropOutraLista(tarefa);
    
            const tarefasDepois = this.tarefas.map(t => t.id);
    
            if (JSON.stringify(tarefasAntes) !== JSON.stringify(tarefasDepois)) {
                $dispatch('lista-tarefas-atualizada', { id: '{{ $id }}', tarefas: this.tarefas });
            }
    
            event.preventDefault();
        },
        dropPropriaLista(tarefa) {
            if (this.tarefaSobreposta) {
                const index = this.tarefas.findIndex(t => t.id === this.tarefaSobreposta.id);
                this.tarefas = this.tarefas.filter(t => t.id != tarefa.id);
                this.tarefas.splice(index, 0, tarefa);
            }
    
            this.dragging = null;
        },
        dropOutraLista(tarefa) {
            if (this.tarefaSobreposta) {
                const index = this.tarefas.findIndex(t => t.id === this.tarefaSobreposta.id);
                this.tarefas.splice(index, 0, tarefa);
            } else {
                this.tarefas.push(tarefa);
            }
        },
        onClickTarefa(tarefa) {
            if (tarefa !== this.tarefaSelecionada) {
                $dispatch('tarefa-selecionada', { tarefa });
            }
        },
        onTarefaSelecionada(event) {
            this.tarefaSelecionada = event.detail.tarefa;
        }
    
    }">
    @isset($titulo)
        <span {{ $titulo->attributes->class(['h5']) }}>{{ $titulo }}</span>
    @endisset

    @if ($pesquisa)
        <x-input id="{{ $id }}-pesquisar" container-class="mt-2 mb-2" type="text" class="form-control"
            placeholder="Pesquisar..." x-model="search" />
    @endif

    <div class="h-100 flex-grow-1 border overflow-y-auto bg-light"
        @if ($draggable) @dragenter="onDragEnter($event)"
        @dragover="onDragOver($event)" @dragleave="onDragLeave($event)" @drop="onDragDrop($event)" @endif>
        <ul class="list-group list-group-flush">
            <template x-for="tarefa in filteredTarefas()" :key="tarefa.id">
                <li :class="{
                    'active': tarefaSelecionada?.id === tarefa.id,
                    'list-group-item list-group-item-action': true
                }"
                    @if ($draggable) draggable="true" @dragstart="onDragStart($event, tarefa)"
                    @dragend="onDragEnd($event)" @dragenter="onDragEnter($event, tarefa)"
                    @dragleave="onDragLeave($event, tarefa)" @endif
                    @if ($selecionavel) @click="onClickTarefa(tarefa)"> @endif <div
                    class="d-flex justify-content-between align-items-center">
                    <span x-text="tarefa.id + ' - ' + tarefa.titulo"></span>
                    <a :class="{
                        'badge rounded-pill': true,
                        'text-bg-primary': !(tarefaSelecionada?.id === tarefa.id),
                        'text-bg-destaque': tarefaSelecionada?.id === tarefa.id
                    }":href="'{{ $urlBase }}' + tarefa.id"
                        target="_blank" class="badge text-bg-primary rounded-pill">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
    </div>
    </li>
    </template>
    </ul>
</div>
</div>
