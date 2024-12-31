@props(['sprint'])

<x-sidebar>
    <x-sidebar-item href="{{ route('pagina-sprint-report', ['sprint' => $sprint]) }}"
        active="{{ request()->routeIs('pagina-sprint-report') }}">
        Report
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-sprint-backlog', ['sprint' => $sprint]) }}"
        active="{{ request()->routeIs('pagina-sprint-backlog') }}">
        Backlog
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-sprint-kanban', ['sprint' => $sprint]) }}"
        active="{{ request()->routeIs('pagina-sprint-kanban') }}">
        Kanban
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-sprint-eventos', ['sprint' => $sprint]) }}"
        active="{{ request()->routeIs([
            'pagina-sprint-eventos',
            'pagina-sprint-criar-evento',
            'pagina-sprint-alterar-evento',
            'pagina-sprint-acessar-evento',
        ]) }}">
        Eventos
    </x-sidebar-item>
    <x-sidebar-item href="{{ route('pagina-sprint-detalhar', ['sprint' => $sprint]) }}"
        active="{{ request()->routeIs('pagina-sprint-detalhar') }}">
        Detalhar
    </x-sidebar-item>
</x-sidebar>
