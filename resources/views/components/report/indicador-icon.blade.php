@props([
    'valor',
    'icone',
    'pequeno' => true,
    'legenda',
    'container' => null,
    'icon' => null,
    'badge' => null,
    'valorContainer' => null,
    'iconLarge' => null,
])

@if ($pequeno)
    <div {{ $container?->attributes->class(['btn btn-sm btn position-relative fs-6']) }}
        @class(['btn position-relative' => !$container]) title="{{ $legenda }}">
        <i {{ $icon?->attributes->class(['bi bi-' . $icone . ' position-relative']) }} @class(['bi bi-' . $icone . ' position-relative' => !$icon])></i>
        <span
            {{ $badge?->attributes->class(['position-absolute top-0 start-100 translate-middle badge rounded-pill']) }}
            @class([
                'position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-destaque' => !$badge,
            ])>
            {{ $valor }}
            <span class="visually-hidden">{{ $legenda }}</span>
        </span>
    </div>
@else
    <div {{ $container?->attributes->class(['d-flex flex-column align-items-center']) }} @class(['d-flex flex-column align-items-center' => !$container])
        title="{{ $legenda }}">
        <strong {{ $valorContainer?->attributes->class(['fs-1']) }}
            @class(['fs-1' => !$valorContainer])>{{ $valor }}</strong>
        <i {{ $iconLarge?->attributes->class(['bi bi-' . $icone . ' position-relative fs-4']) }}
            @class(['bi bi-' . $icone . ' position-relative fs-4' => !$iconLarge])></i>
    </div>
@endif
