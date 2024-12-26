@props(['projeto'])

<x-sidebar>
    <x-sidebar-item href="{{ route('pagina-projeto-report', ['projeto' => $projeto]) }}"
        active="{{ request()->routeIs('pagina-projeto-report') }}">
        Report
    </x-sidebar-item>
</x-sidebar>
