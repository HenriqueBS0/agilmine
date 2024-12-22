@props(['gatilhoId'])

<div {{ $attributes->merge(['class' => 'dropdown']) }}>

    <a
        {{ $gatilho->attributes->merge([
            'id' => $gatilhoId,
            'class' => 'dropdown-toggle',
            'href' => '#',
            'role' => 'button',
            'data-bs-toggle' => 'dropdown',
            'aria-expanded' => 'false',
        ]) }}>
        {{ $gatilho }}
    </a>

    <ul {{ $menu->attributes->merge(['class' => 'dropdown-menu']) }} aria-labelledby="{{ $gatilhoId }}">
        {{ $menu }}
    </ul>
</div>
