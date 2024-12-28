@props([
    'id' => 'switch-' . uniqid(),
    'checked' => false,
    'disabled' => false,
    'label' => null,
])

@if (isset($container))
    <div {{ $container->class(['form-check form-switch']) }} id="{{ $id }}-container">
    @else
        <div class="form-check form-switch" id="{{ $id }}-container">
@endif


<input type="checkbox" role="switch" id="{{ $id }}" {{ $checked ? 'checked' : '' }}
    {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-check-input']) }}>
@if ($label)
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
@endif
</div>
