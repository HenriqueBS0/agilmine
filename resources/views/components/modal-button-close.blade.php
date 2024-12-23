@props(['modalId'])

<button
    {{ $attributes->merge([
        'type' => 'button',
        'aria-label' => 'Close',
        'data-bs-dismiss' => 'modal',
        'data-bs-target' => "#{$modalId}",
    ]) }}>
    {{ $slot }}
</button>
