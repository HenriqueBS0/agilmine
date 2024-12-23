@props(['modalId'])

<button
    {{ $attributes->merge([
        'type' => 'button',
        'data-bs-toggle' => 'modal',
        'data-bs-target' => "#{$modalId}",
    ]) }}>
    {{ $slot }}
</button>
