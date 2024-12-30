<div class="row g-2" @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    terminado: null,
    horasEstimadas: null,
    horasGastas: null,
    dataCriacao: null,
    dataUltimaAlteracao: null,
    dataPrevista: null,
    dataInicio: null,
    dataConclusao: null,
    onTarefaSelecionada(event) {
        const tarefa = event.detail.tarefa;

        this.terminado = tarefa.proporcaoFeita;
        this.horasEstimadas = tarefa.stringHorasEstimadas;
        this.horasGastas = tarefa.stringHorasGastas;

        const dateTimeToString = data => data?.date ? data.date.split(' ')[0] : null;

        this.dataCriacao = dateTimeToString(tarefa.dataCriacao);
        this.dataUltimaAlteracao = dateTimeToString(tarefa.dataAtualizacao);
        this.dataPrevista = dateTimeToString(tarefa.dataConclusaoEstimada);
        this.dataInicio = dateTimeToString(tarefa.dataInicio);
        this.dataConclusao = dateTimeToString(tarefa.dataConclusao);
    },
}">
    <x-input x-model="terminado" container-class="col-2" class="form-control-sm" id="terminado" type="number" disabled>
        <x-slot:label>% Terminado</x-slot:label>
    </x-input>
    <x-input x-model="horasEstimadas" container-class="col-2" class="form-control-sm" id="horas-estimadas" type="time"
        disabled>
        <x-slot:label>Horas Estimadas</x-slot:label>
    </x-input>
    <x-input x-model="horasGastas" container-class="col-2" class="form-control-sm" id="horas-gastas" type="time"
        disabled>
        <x-slot:label>Horas Gastas</x-slot:label>
    </x-input>
    <x-input x-model="dataCriacao" container-class="col-2" class="form-control-sm" id="data-criacao" type="date"
        disabled>
        <x-slot:label>Data Criação</x-slot:label>
    </x-input>
    <x-input x-model="dataUltimaAlteracao" container-class="col-2" class="form-control-sm" id="data-ultima-alteracao"
        type="date" disabled>
        <x-slot:label>Data Última Alteração</x-slot:label>
    </x-input>
    <x-input x-model="dataPrevista" container-class="col-2" class="form-control-sm" id="data-prevista" type="date"
        disabled>
        <x-slot:label>Data Prevista</x-slot:label>
    </x-input>
    <x-input x-model="dataInicio" container-class="col-6" class="form-control-sm" id="data-inicio" type="date"
        disabled>
        <x-slot:label>Data Início</x-slot:label>
    </x-input>
    <x-input x-model="dataConclusao" container-class="col-6" class="form-control-sm" id="data-conclusao" type="date"
        disabled>
        <x-slot:label>Data Conclusão</x-slot:label>
    </x-input>
</div>
