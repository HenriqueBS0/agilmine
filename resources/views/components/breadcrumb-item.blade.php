@props([
    'href' => null,
    'active' => false,
])

@if ($active)
    <li {{ $attributes->merge(['class' => 'breadcrumb-item active']) }} aria-current="page">
        {{ $slot }}
    </li>
@else
    <li {{ $attributes->merge(['class' => 'breadcrumb-item']) }}>
        <a href="{{ $href }}">{{ $slot }}</a>
    </li>
@endif
