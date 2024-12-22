@props([
    'id' => 'switch-' . uniqid(),
    'checked' => false,
    'disabled' => false,
    'label' => null,
])

<div class="form-check form-switch">
    <input type="checkbox" role="switch" id="{{ $id }}" {{ $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-check-input']) }}>
    @if ($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @endif
</div>
