<div class="row g-2" @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    autor: null,
    descritor: null,
    desenvolvedor: null,
    testador: null,
    onTarefaSelecionada(event) {
        const { autor, descritor, desenvolvedor, testador } = event.detail.tarefa;
        this.autor = autor.id;
        this.descritor = descritor.id;
        this.desenvolvedor = desenvolvedor.id;
        this.testador = testador.id;
    }
}">
    <x-input x-model="autor" container-class="col-6" class="form-select-sm" type="select" disabled id="autor">
        <x-slot:label>Autor</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($membros as $membro)
                <option value="{{ $membro->getUsuario()->getId() }}">{{ $membro->getUsuario()->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>
    <x-input x-model="desenvolvedor" container-class="col-6" class="form-select-sm" type="select" disabled
        id="desenvolvedor">
        <x-slot:label>Desenvolvedor</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($membros as $membro)
                <option value="{{ $membro->getUsuario()->getId() }}">{{ $membro->getUsuario()->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>
    <x-input x-model="descritor" container-class="col-6" class="form-select-sm" type="select" disabled id="descritor">
        <x-slot:label>Descritor</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($membros as $membro)
                <option value="{{ $membro->getUsuario()->getId() }}">{{ $membro->getUsuario()->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>
    <x-input x-model="testador" container-class="col-6" class="form-select-sm" type="select" disabled id="testador">
        <x-slot:label>Testador</x-slot:label>
        <x-slot:select>
            <option></option>
            @foreach ($membros as $membro)
                <option value="{{ $membro->getUsuario()->getId() }}">{{ $membro->getUsuario()->getNome() }}</option>
            @endforeach
        </x-slot:select>
    </x-input>
</div>
