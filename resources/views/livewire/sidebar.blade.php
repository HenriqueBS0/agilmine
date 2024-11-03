<x-sidebar>
    @foreach ($itens as $item)
        @if (strtoupper($item['nome']) == strtoupper($atual))
            <x-sidebar.item-atual wire:key="{{ $item['nome'] }}">{{ $item['nome'] }}</x-sidebar.item-atual>
        @else
            <x-sidebar.item href="{{ $item['href'] }}">{{ $item['nome'] }}</x-sidebar.item>
        @endif
    @endforeach

</x-sidebar>
