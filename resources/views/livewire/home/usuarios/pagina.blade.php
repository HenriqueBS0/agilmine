<x-slot:navbar>
    <x-home.navbar />
</x-slot:navbar>
<x-slot:sidebar>
    <x-home.sidebar />
</x-slot:sidebar>
<x-main titulo="Usuários">
    <x-modal-confirmacao id="confirmar-geracao-senha" titulo="Confirmar Geração de Senha"
        mensagem="Deseja realmente gerar uma nova senha para o usuário {{ $usuarioSelecionado?->name }}?">
        <x-slot:confirm class="btn btn-warning" wire:click='gerarNovaSenha'>Gerar</x-slot:confirm>
    </x-modal-confirmacao>

    <x-modal id="menasgem-informacao-senha" titulo="Nova Senha Gerada">
        <p>Senha <strong>{{ $novaSenha }}</strong> gerada para o usuário {{ $usuarioSelecionado?->name }}</p>
    </x-modal>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Habilitado</th>
                <th scope="col">Administrador</th>
                <th scope="col">Senha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td scope="col">{{ $usuario->id }}</td>
                    <td scope="col">{{ $usuario->name }}</td>
                    <td scope="col">{{ $usuario->email }}</td>
                    <td scope="col">
                        <x-input-switch :checked="$usuario->habilitado" :disabled="$usuario->id === auth()->id()"
                            wire:input="atualizarHabilitado({{ $usuario->id }}, $event.target.checked)" />
                    </td>
                    <td scope="col">
                        <x-input-switch :checked="$usuario->admin" :disabled="$usuario->id === auth()->id()"
                            wire:input="atualizarAdmin({{ $usuario->id }}, $event.target.checked)" />
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="confirmarGeracaoSenha({{ $usuario->id }})">
                            Gerar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main>
