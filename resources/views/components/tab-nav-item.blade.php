@props(['id', 'active' => false])

<li class="nav-item" role="presentation">
    <button @class(['nav-link', 'active' => $active]) id="{{ $id }}-tab" data-bs-toggle="tab"
        data-bs-target="#{{ $id }}-tab-pane" type="button" role="tab"
        aria-controls="{{ $id }}-tab-pane" aria-selected="true">{{ $slot }}</button>
</li>
