@props(['projeto'])

<x-sidebar>
    <x-sidebar-item href="{{ route('pagina-projeto-report', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-report') }}">
        Report
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-projeto-backlog', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-backlog') }}">
        Backlog
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-projeto-kanban', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-kanban') }}">
        Kanban
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-projeto-membros', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-membros') }}">
        Membros
    </x-sidebar-item>
    @can('isGestor', $projeto)
        <x-sidebar-item href="{{ route('pagina-projeto-configuracoes', ['projeto' => $projeto]) }}"
            active="{{ request()->routeIs('pagina-projeto-configuracoes') }}">
            Configurações
        </x-sidebar-item>
    @endcan
    <x-sidebar-item href="{{ route('pagina-projeto-sprints', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-sprints') || request()->routeIs('pagina-projeto-criar-sprint') }}">
        Sprints
    </x-sidebar-item>
</x-sidebar>
