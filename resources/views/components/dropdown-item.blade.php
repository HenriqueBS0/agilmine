@props(['href' => '#', 'active' => false, 'disabled' => false, 'class' => ''])

<li>
    <a
        {{ $attributes->merge([
            'class' => 'dropdown-item ' . ($active ? 'active ' : '') . ($disabled ? 'disabled ' : '') . $class,
            'href' => $disabled ? '#' : $href,
            'aria-current' => $active ? 'true' : null,
            'aria-disabled' => $disabled ? 'true' : null,
        ]) }}>
        {{ $slot }}
    </a>
</li>
