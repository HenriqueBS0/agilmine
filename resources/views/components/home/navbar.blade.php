<x-navbar>
    @if (request()->routeIs('pagina-projetos'))
        <x-slot:breadcrumb>
            <x-breadcrumb class="m-0">
                <x-breadcrumb-item active>Projetos</x-breadcrumb-item>
            </x-breadcrumb>
        </x-slot:breadcrumb>
    @endif
</x-navbar>
