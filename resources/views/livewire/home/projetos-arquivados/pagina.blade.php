<x-slot:navbar>
    <x-home.navbar />
</x-slot:navbar>
<x-slot:sidebar>
    <x-home.sidebar />
</x-slot:sidebar>
<x-main titulo="Projetos Arquivados">
    <div class="row g-3">
        @foreach ($projetos as $projeto)
            <div class="col-4">
                <x-home.projetos-arquivados.card class="h-100" :projeto="$projeto">
                    <x-slot:desarquivar wire:click='desarquivar({{ $projeto->id }})'></x-slot:desarquivar>
                </x-home.projetos-arquivados.card>
            </div>
        @endforeach
    </div>
</x-main>
