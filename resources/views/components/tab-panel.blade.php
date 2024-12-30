@props(['id', 'active' => false])


<div
    {{ $attributes->class(['tab-pane', 'active' => $active])->merge([
        'id' => "{$id}-tab-pane",
        'role' => 'tabpanel',
        'aria-labelledby' => 'identificacao-tab',
        'tabindex' => '0',
    ]) }}>
    {{ $slot }}
</div>
