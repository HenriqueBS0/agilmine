@props(['id', 'projeto', 'tarefas' => [], 'selecionavel' => false, 'pesquisa' => false])

@php
    use Livewire\Wireable;

    $urlBase = App\Models\Configuracao::getRedmineUrlApi(true) . '/issues/';

    $fnRecursiveToLivewire = function (Wireable $wireable) use (&$fnRecursiveToLivewire) {
        $attributesEntidade = $wireable->toLivewire();

        foreach ($attributesEntidade as $key => $value) {
            if ($value instanceof Wireable) {
                $attributesEntidade[$key] = $fnRecursiveToLivewire($value);
            } elseif (is_array($value)) {
                $attributesEntidade[$key] = array_map(function ($item) {
                    return $item instanceof Wireable ? $fnRecursiveToLivewire($item) : $item;
                }, $value);
            }
        }

        return $attributesEntidade;
    };

    $arrayTarefas = array_map(fn($tarefa) => $fnRecursiveToLivewire($tarefa), $tarefas);

@endphp


<div id="{{ $id }}" class="h-100 d-flex flex-column" @tarefa-selecionada.window="onTarefaSelecionada($event)"
    x-data="{
        tarefas: {{ Js::from($arrayTarefas) }},
        search: '',
        dragging: null,
        tarefaSobreposta: null,
        tarefaSelecionada: null,
        totalTarefas() {
            return this.tarefas.length;
        },
        totalHorasEstimadas() {
            const totalHoras = this.tarefas.reduce((total, tarefa) => {
                return total + (tarefa.horasEstimadas || 0);
            }, 0);
    
            const horas = Math.floor(totalHoras);
            const minutos = Math.round((totalHoras - horas) * 60);
            return `${horas}:${minutos.toString().padStart(2, '0')}`;
        },
        totalStoryPoints() {
            return this.tarefas.reduce((total, tarefa) => {
                return total + (tarefa.pontosHistoria || 0);
            }, 0);
        },
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
                $dispatch('lista-tarefas-atualizada', { id: '{{ $id }}', tarefas: this.tarefas, tarefa: tarefa });
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
    <div class="d-flex justify-content-between align-items-center">
        @isset($titulo)
            <span {{ $titulo->attributes->class(['h5']) }}>{{ $titulo }}</span>
        @endisset

        <!-- Totais alinhados à direita -->
        <div class="text-end flex-grow-1">
            <span x-html="'<strong>Tarefas:</strong> ' + totalTarefas()"></span>
            @can('isMetricaHorasAtiva', $projeto)
                <span x-html="'<strong>Horas Estimadas:</strong> ' + totalHorasEstimadas()"></span>
            @endcan
            @can('isMetricaStoryPointsAtiva', $projeto)
                <span x-html="'<strong>Story Points:</strong> ' + totalStoryPoints()"></span>
            @endcan
        </div>
    </div>

    @if ($pesquisa)
        <x-input id="{{ $id }}-pesquisar" container-class="mt-2 mb-2" type="text" class="form-control"
            placeholder="Pesquisar..." x-model="search" />
    @endif

    <div class="h-100 flex-grow-1 border overflow-y-auto bg-light"
        @can('isGestor', $projeto)
            @dragenter="onDragEnter($event)"
            @dragover="onDragOver($event)" 
            @dragleave="onDragLeave($event)" 
            @drop="onDragDrop($event)"
        @endcan>
        <ul class="list-group list-group-flush">
            <template x-for="tarefa in filteredTarefas()" :key="tarefa.id">
                <li :class="{
                    'active': tarefaSelecionada?.id === tarefa.id,
                    'list-group-item list-group-item-action': true
                }"
                    @can('isGestor', $projeto)
                draggable="true" @dragstart="onDragStart($event, tarefa)"
                    @dragend="onDragEnd($event)" @dragenter="onDragEnter($event, tarefa)"
                    @dragleave="onDragLeave($event, tarefa)"
            @endcan
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
