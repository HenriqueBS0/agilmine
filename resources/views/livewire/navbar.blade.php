<x-navbar>
    <x-slot:breadcrumb>
        <x-navbar.breadcrumb>
            @foreach ($itens as $item)
                <x-navbar.breadcrumb.item href="{{ $item['href'] }}"
                    wire:key="{{ $item['nome'] }}">{{ $item['nome'] }}</x-navbar.breadcrumb.item>
            @endforeach

            <x-navbar.breadcrumb.item-atual>{{ $atual }}</x-navbar.breadcrumb.item-atual>
        </x-navbar.breadcrumb>
    </x-slot:breadcrumb>
</x-navbar>
