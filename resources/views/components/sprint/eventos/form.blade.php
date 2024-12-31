<form class="row g-3" wire:submit="save">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informações</h5>
                <div class="row">
                    <x-input id="tipo" wire:model="form.tipo" monitor-erro="form.tipo" type="select"
                        container-class="col-6" :disabled="$disabilitado">
                        <x-slot:label>Tipo</x-slot:label>
                        <x-slot:select>
                            <option>Selecione</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo->getDescricao() }}</option>
                            @endforeach
                        </x-slot:select>
                    </x-input>

                    <x-input id="data-hora" wire:model="form.data_hora" monitor-erro="form.data_hora"
                        type="datetime-local" container-class="col-6" :disabled="$disabilitado">
                        <x-slot:label>Data Hora</x-slot:label>
                    </x-input>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <span>Participantes</span>
                </h5>
                <div class="row">
                    <div class="row">
                        @foreach ($membros as $membro)
                            <x-input value="{{ $membro->getUsuario()->getId() }}" wire:model="form.membros"
                                container-class="col-3" id="membro-{{ $membro->getUsuario()->getId() }}" type="switch"
                                :disabled="$disabilitado">
                                <x-slot:label>{{ $membro->getUsuario()->getNome() }}</x-slot:label>
                            </x-input>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 flex-grow-1">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <span>Ata</span>
                </h5>
                <x-editor style="height: 400px" id="descricao" monitor-erro="form.descricao" :options="['readOnly' => $disabilitado]">
                    {!! $form->descricao ?? null !!}
                </x-editor>

            </div>
        </div>
    </div>
    <!-- Botão Salvar -->
    <div class="col-12 text-end my-3">
        @if (!$disabilitado)
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
        @endif
        @isset($cancelar)
            <a class="btn btn-secondary" href="{{ $cancelar }}">Cancelar</a>
        @endisset

    </div>
</form>
@script
    <script type="module">
        Editores.get('descricao').on('editor-change', (eventName, ...args) => {
            const conteudo = Editores.get('descricao').root.innerHTML;

            if (conteudo === '<p><br></p>') {
                $wire.form.descricao = null;
                return;
            }

            $wire.form.descricao = conteudo;
        });
    </script>
@endscript
