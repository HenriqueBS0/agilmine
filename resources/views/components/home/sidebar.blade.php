<x-sidebar>
    <x-sidebar-item href="{{ route('pagina-projetos') }}" active="{{ request()->routeIs('pagina-projetos') }}">Projetos
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-projetos-arquivados') }}"
        active="{{ request()->routeIs('pagina-projetos-arquivados') }}">Arquivados
    </x-sidebar-item>
    @can('isAdmin', App\Models\User::class)
        <x-sidebar-item href="{{ route('pagina-usuarios') }}" active="{{ request()->routeIs('pagina-usuarios') }}">Usuários
        </x-sidebar-item>
        <x-sidebar-item href="{{ route('pagina-configuracoes') }}" active="{{ request()->routeIs('pagina-configuracoes') }}">
            Configurações
        </x-sidebar-item>
    @endcan
</x-sidebar>
