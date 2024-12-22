<x-slot:navbar>
    <x-home.navbar />
</x-slot:navbar>
<x-slot:sidebar>
    <x-home.sidebar />
</x-slot:sidebar>
<x-main titulo="Usuários">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Administrador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td scope="col">{{ $usuario->id }}</td>
                    <td scope="col">{{ $usuario->name }}</td>
                    <td scope="col">{{ $usuario->email }}</td>
                    <td scope="col">
                        <x-input-switch :checked="$usuario->admin" :disabled="$usuario->id === auth()->id()"
                            wire:input="atualizarAdmin({{ $usuario->id }}, $event.target.checked)" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main>
