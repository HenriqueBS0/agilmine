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
</x-sidebar>
