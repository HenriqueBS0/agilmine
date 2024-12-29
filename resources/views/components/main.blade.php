@props(['titulo' => ''])

<main {{ $attributes->class(['container-fluid pt-4 pb-4 h-100 d-flex flex-column']) }}>

    @if ($titulo)
        <div class="row">
            <div class="col">
                <h3 class="text-dark">{{ $titulo }}</h3>
            </div>
            @isset($acoes)
                <div class="col d-flex justify-content-end mb-2">
                    {{ $acoes }}
                </div>
            @endisset
        </div>
    @endif
    {{ $slot }}
</main>
