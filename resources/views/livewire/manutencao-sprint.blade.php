<x-slot:navbar>
    <livewire:navbar :$navbarBreadCrumbItens></livewire:navbar>
</x-slot:navbar>
<form wire:submit="salvar" class="container">
    <legend>Sprint - {{ $acao }}</legend>
    <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" aria-describedby="nomeFeedback" wire:model='form.nome'
            required>
        <div id="nomeFeedback" class="invalid-feedback"></div>
    </div>
    <div class="col-12 mb-3">
        <label for="dataInicio" class="form-label">Data Inicio</label>
        <input type="date" class="form-control" id="dataInicio" aria-describedby="dataInicioFeedback" required
            wire:model='form.data_inicio'>
        <div id="dataInicioFeedback" class="invalid-feedback"></div>
    </div>
    <div class="col-12 mb-3">
        <label for="dataFim" class="form-label">Data Fim</label>
        <input type="date" class="form-control" id="dataFim" aria-describedby="dataFimFeedback"
            wire:model='form.data_fim'required>
        <div id="dataFimFeedback" class="invalid-feedback"></div>
    </div>
    <div class="col-12 mb-3">
        <label for="tarefas" class="form-label">Tarefas</label>
        <select class="form-select" multiple size="10" aria-label="Multiple select example"
            wire:model='form.tarefas_id'>
            @foreach ($tarefas as $tarefa)
                <option @selected(in_array($tarefa->getId(), $form->tarefas_id)) value="{{ $tarefa->getId() }}">{{ $tarefa->getId() }} -
                    {{ $tarefa->getAssunto() }}</option>
            @endforeach
        </select>
        <div id="tarefasFeedback" class="invalid-feedback"></div>
    </div>
    <div class="col-12 mb-3">
        <button type="submit" class="btn btn-{{ $acaoCor }}">{{ $acao }}</button>
    </div>
</form>
