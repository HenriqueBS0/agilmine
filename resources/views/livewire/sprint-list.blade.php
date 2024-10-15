<div class="container">
    <div class="row filtros">

    </div>
    <div class="row acoes pt-2 pb-2">
        <div>
            <button type="button" class="btn btn-primary" wire:click='criar'><i class="bi bi-plus-lg"></i> Criar</button>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Data Inicio</th>
                <th scope="col">Data Fim</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sprints as $sprint)
                <tr>
                    <td scope="col">{{ $sprint->id }}</td>
                    <td scope="col">{{ $sprint->nome }}</td>
                    <td scope="col">{{ $sprint->data_inicio }}</td>
                    <td scope="col">{{ $sprint->data_fim }}</td>
                    <td scope="col">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" wire:click='acessar({{ $sprint->id }})'><i
                                    class="bi bi-eye"></i> Acessar</button>
                            <button type="button" class="btn btn-warning" wire:click='alterar({{ $sprint->id }})'><i
                                    class="bi bi-pencil"></i> Alterar</button>
                            <button type="button" class="btn btn-danger" wire:click='excluir({{ $sprint->id }})'><i
                                    class="bi bi-trash"></i> Excluir</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <livewire:paginacao :$paginacao /> --}}
</div>
