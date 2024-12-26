<x-slot:navbar>
    <x-home.navbar />
</x-slot:navbar>
<x-slot:sidebar>
    <x-home.sidebar />
</x-slot:sidebar>
<x-main titulo="Projetos">
    <div class="row g-3">
        @foreach ($projetos as $projeto)
            <div class="col-4">
                <x-home.projetos.card class="h-100" :projeto="$projeto">
                    <x-slot:arquivar wire:click='arquivar({{ $projeto->id }})'></x-slot:arquivar>
                </x-home.projetos.card>
            </div>
        @endforeach
    </div>
</x-main>
