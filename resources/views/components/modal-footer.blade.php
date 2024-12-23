@props(['modalId', 'fechar' => true])

<div {{ $attributes->class(['modal-footer']) }}>
    {{ $slot }}
    @if ($fechar)
        <x-modal-button-close class="btn btn-secondary" :modal-id="$modalId">Fechar</x-modal-button-close>
    @endif
</div>
