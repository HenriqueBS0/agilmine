@props(['projeto'])

<x-navbar>
    <x-slot:breadcrumb>
        <x-breadcrumb class="m-0">
            <x-breadcrumb-item href="{{ route('pagina-projetos') }}">Projetos</x-breadcrumb-item>
            <x-breadcrumb-item active>{{ $projeto->nome }}</x-breadcrumb-item>
        </x-breadcrumb>
    </x-slot:breadcrumb>
</x-navbar>
