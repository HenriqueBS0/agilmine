@props(['titulo' => ''])

<main class="container-fluid pt-3 pb-3">
    @if ($titulo)
        <h3 class="text-dark">{{ $titulo }}</h3>
    @endif
    {{ $slot }}
</main>
