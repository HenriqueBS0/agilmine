<x-sidebar>
    <x-sidebar-item href="{{ route('pagina-projetos') }}" active="{{ request()->routeIs('pagina-projetos') }}">Projetos
    </x-sidebar-item>
    @can('isAdmin', App\Models\User::class)
    <x-sidebar-item href="{{ route('pagina-usuarios') }}" active="{{ request()->routeIs('pagina-usuarios') }}">Usuários
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-projetos') }}" active="{{ request()->routeIs('pagina-projetos') }}">
        Configurações
    </x-sidebar-item>
    @endcan
</x-sidebar>