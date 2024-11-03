<form wire:submit='{{ $save }}' class="container">
    <div class="row g-3">
        <x-input-text id="nome" label="Nome" model="form.nome" containerClass="col-12" :readonly="$leitura"
            :disabled="$leitura" event="blur" />
        <x-input-textarea id="resumo" label="Resumo" model="form.resumo" containerClass="col-12" :readonly="$leitura"
            :disabled="$leitura" event="blur" />
        <x-input-date id="data_inicio" label="Data Inicio" model="form.data_inicio" containerClass="col-6"
            :readonly="$leitura" :disabled="$leitura" event="blur" />
        <x-input-date id="data_fim" label="Data Fim" model="form.data_fim" containerClass="col-6" :readonly="$leitura"
            :disabled="$leitura" event="blur" />
        <x-input-checkbox id="gera_release" label="Gera release" model="form.gera_release" containerClass="col-12"
            :readonly="$leitura" :disabled="$leitura" event="blur" />

        @if (!$leitura)
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Enviar</button>
                <button class="btn btn-secondary" type="button" wire:click='cancelar'>Cancelar</button>
            </div>
        @endif
    </div>
</form>
