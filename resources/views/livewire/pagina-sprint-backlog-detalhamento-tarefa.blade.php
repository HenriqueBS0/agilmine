<div class="col-12" @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    tarefaSelecionada: null,
    onTarefaSelecionada(event) {
        const tarefaId = event.detail.tarefa.id;

        if (tarefaId === this.tarefaSelecionada) {
            return;
        }

        this.tarefaSelecionada = tarefaId;
        $wire.setTarefa(event.detail.tarefa.id);
    }
}">
    <h4>Tarefa</h4>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="identificacao-tab" data-bs-toggle="tab"
                        data-bs-target="#identificacao-tab-pane" type="button" role="tab"
                        aria-controls="identificacao-tab-pane" aria-selected="true">Identificação</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="acompanhamento-tab" data-bs-toggle="tab"
                        data-bs-target="#acompanhamento-tab-pane" type="button" role="tab"
                        aria-controls="acompanhamento-tab-pane" aria-selected="true">Acompanhamento</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="membros-tab" data-bs-toggle="tab" data-bs-target="#membros-tab-pane"
                        type="button" role="tab" aria-controls="membros-tab-pane"
                        aria-selected="true">Membros</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="descricao-tab" data-bs-toggle="tab"
                        data-bs-target="#descricao-tab-pane" type="button" role="tab"
                        aria-controls="descricao-tab-pane" aria-selected="true">Descrição</button>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane container active" id="identificacao-tab-pane" role="tabpanel"
                aria-labelledby="identificacao-tab" tabindex="0">
                <div class="row g-2">
                    <x-input-number containerClass="col-1" label="Id" id="identificador" model="identificador"
                        :disabled=true />
                    <x-input-text containerClass="col-11" label="Titulo" id="titulo" model="titulo" :disabled=true />
                    <x-input-select containerClass="col-2" label="Prioridade" id="prioridade" model="prioridade"
                        :disabled=true :options="$prioridades" />
                    <x-input-number containerClass="col-2" label="Story Points" id="storyPoints" model="storyPoints"
                        :disabled=true />
                    <x-input-select containerClass="col-4" label="Tipo" id="tipo" model="tipo" :disabled=true
                        :options="$tipos" />
                    <x-input-select containerClass="col-4" label="Status" id="status" model="status" :disabled=true
                        :options="$statusList" />
                </div>
            </div>
            <div class="tab-pane container" id="acompanhamento-tab-pane" role="tabpanel"
                aria-labelledby="acompanhamento-tab" tabindex="0">
                <div class="row g-2">
                    <x-input-number containerClass="col-2" label="% Terminado" id="proporcaoFeita"
                        model="proporcaoFeita" :disabled=true />
                    <x-input-text containerClass="col-2" label="Horas Estimadas" id="horasEstimadas"
                        model="horasEstimadas" :disabled=true />
                    <x-input-text containerClass="col-2" label="Horas Gastas" id="horasGastas" model="horasGastas"
                        :disabled=true />
                    <x-input-date containerClass="col-2" label="Data Criação" id="dataCriacao" model="dataCriacao"
                        :disabled=true />
                    <x-input-date containerClass="col-2" label="Data Ultima Alteração" id="dataUltimaAlteracao"
                        model="dataUltimaAlteracao" :disabled=true />
                    <x-input-date containerClass="col-2" label="Data Prevista" id="dataPrevista"
                        model="dataPrevista" :disabled=true />
                    <x-input-date containerClass="col-6" label="Data Inicio" id="dataInicio" model="dataInicio"
                        :disabled=true />
                    <x-input-date containerClass="col-6" label="Data Conclusão" id="dataConclusao"
                        model="dataConclusao" :disabled=true />
                </div>
            </div>
            <div class="tab-pane container" id="membros-tab-pane" role="tabpanel" aria-labelledby="membros-tab"
                tabindex="0">
                <div class="row g-2">
                    <x-input-select containerClass="col-6" label="Autor" id="autor" model="autor"
                        :disabled=true :options="$membros" />
                    <x-input-select containerClass="col-6" label="Desenvolvedor" id="desenvolvedor"
                        model="desenvolvedor" :disabled=true :options="$membros" />
                    <x-input-select containerClass="col-6" label="Descritor" id="descritor" model="descritor"
                        :disabled=true :options="$membros" />
                    <x-input-select containerClass="col-6" label="Testador" id="testador" model="testador"
                        :disabled=true :options="$membros" />
                </div>
            </div>
            <div class="tab-pane" id="descricao-tab-pane" role="tabpanel" aria-labelledby="descricao-tab"
                tabindex="0">
                <p class="card-text overflow-y-auto" style="max-height: 200px">
                    {{ $descricao }}
                </p>
            </div>
        </div>
        <div class="card-footer">
            @if ($identificador)
                <a class="btn btn-sm btn-primary border-0" target="_blank"
                    href="http://fabtec.ifc-riodosul.edu.br/issues/{{ $identificador }}"><i
                        class="bi bi-box-arrow-up-right"></i> Acessar</a>
            @else
                <button class="btn btn-sm text-bg-primary border-0" disabled><i class="bi bi-box-arrow-up-right"></i>
                    Acessar</button>
            @endif
        </div>
    </div>
</div>
