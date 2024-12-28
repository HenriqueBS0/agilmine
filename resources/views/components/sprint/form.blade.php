@props(['titulo', 'vercoes' => [], 'sprint' => null, 'cancelar' => '#'])


<div class="card" x-data="{ geraRelease: $wire.entangle('form.gera_release') }">
    <form class="card-body" wire:submit="save">
        <h5 class="card-title">{{ $titulo }}</h5>

        <div class="row">

            @isset($sprint)
                <x-input id="nome" container-class="mb-3 col-12" type="number" wire:model="sprint.serial"
                    monitor-erro="sprint.serial" disabled>
                    <x-slot:label>Id</x-slot:label>
                </x-input>
            @endisset


            <x-input id="nome" container-class="mb-3 col-12" type="text" wire:model="form.nome"
                monitor-erro="form.nome">
                <x-slot:label>Nome</x-slot:label>
            </x-input>

            <x-input id="resumo" container-class="mb-3 col-12" type="textarea" wire:model="form.resumo"
                monitor-erro="form.resumo">
                <x-slot:label>Resumo</x-slot:label>
            </x-input>

            <x-input id="data_inicio" container-class="mb-3 col-6" type="date" wire:model="form.data_inicio"
                monitor-erro="form.data_inicio">
                <x-slot:label>Data Inicio</x-slot:label>
            </x-input>

            <x-input id="data_fim" container-class="mb-3 col-6" type="date" wire:model="form.data_fim"
                monitor-erro="form.data_fim">
                <x-slot:label>Data Fim</x-slot:label>
            </x-input>

            <x-input id="versao" container-class="mb-3 col-12" type="select" wire:model="form.versao"
                monitor-erro="form.versao">
                <x-slot:label>Versão</x-slot:label>
                <x-slot:select>
                    <option>Selecione</option>
                    @foreach ($vercoes as $vercao)
                        <option value="{{ $vercao->getId() }}">{{ $vercao->getNome() }}</option>
                    @endforeach
                </x-slot:select>
            </x-input>

            <x-input id="gera-release" container-class="mb-3 col-12" type="switch" wire:model="form.gera_release"
                monitor-erro="form.gera_release">
                <x-slot:label>Gera Release</x-slot:label>
            </x-input>

            <x-input id="resumo-release" container-class="mb-3 col-12" type="textarea" wire:model="form.resumo_release"
                monitor-erro="form.resumo_release" container-x-show="geraRelease" container-x-cloak>
                <x-slot:label>Resumo Release</x-slot:label>
            </x-input>
        </div>

        <button class="btn btn-primary" type="submit">Salvar</button>
        <a class="btn btn-secondary" href="{{ $cancelar }}">Cancelar</a>
</div>
