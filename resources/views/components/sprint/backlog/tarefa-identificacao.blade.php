<div class="row g-2" @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    id: null,
    titulo: null,
    prioridade: null,
    pontosHistoria: null,
    tipo: null,
    status: null,
    onTarefaSelecionada(event) {
        const tarefa = event.detail.tarefa
        this.id = tarefa.id;
        this.titulo = tarefa.titulo;
        this.prioridade = tarefa.prioridade.id;
        this.pontosHistoria = tarefa.pontosHistoria;
        this.tipo = tarefa.tipo.id;
        this.status = tarefa.status.id;
    }
}">
    <x-input x-model="id" container-class="col-1" class="form-control-sm" type="number" disabled id="id">
        <x-slot:label>ID</x-slot:label>
    </x-input>

    <x-input x-model="titulo" container-class="col-11" class="form-control-sm" type="text" disabled id="titulo">
        <x-slot:label>Titulo</x-slot:label>
    </x-input>

    <x-input x-model="prioridade" container-class="col-2" class="form-select-sm" type="select" disabled
        id="prioridade">
        <x-slot:label>Prioridade</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($prioridades as $prioridade)
                <option value="{{ $prioridade->getId() }}">{{ $prioridade->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>

    <x-input x-model="pontosHistoria" container-class="col-2" class="form-control-sm" type="number" disabled
        id="story-points">
        <x-slot:label>Story Points</x-slot:label>
    </x-input>

    <x-input x-model="tipo" container-class="col-4" class="form-select-sm" type="select" disabled id="tipo">
        <x-slot:label>Tipo</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->getId() }}">{{ $tipo->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>

    <x-input x-model="status" container-class="col-4" class="form-select-sm" type="select" disabled id="status">
        <x-slot:label>Status</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($status as $statusItem)
                <option value="{{ $statusItem->getId() }}">{{ $statusItem->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>
</div>
