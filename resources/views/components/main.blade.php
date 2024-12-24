@props(['titulo' => ''])

<main {{ $attributes->class(['container-fluid pt-4 pb-4']) }}>
    @if ($titulo)
        <h3 class="text-dark">{{ $titulo }}</h3>
    @endif
    {{ $slot }}
</main>
