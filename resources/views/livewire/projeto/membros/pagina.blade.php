<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-main titulo="Membros">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Perfis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($membros as $membro)
                <tr>
                    <td scope="col">{{ $membro->getUsuario()->getId() }}</td>
                    <td scope="col">{{ $membro->getUsuario()->getNome() }}</td>
                    <td scope="col">{{ $membro->perfisToString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main>
