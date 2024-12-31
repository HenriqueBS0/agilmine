@props(['id', 'options' => [], 'monitorErro' => null])

<div wire:ignore>
    <div {{ $attributes->merge(['id' => $id]) }}>
        {{ $slot }}
    </div>
</div>

@error($monitorErro)
    <div>
        <div class="is-invalid"></div>
        <x-input-feedback :$id :$monitorErro />
    </div>
@enderror


@pushOnce('scripts')
    @vite('resources/js/components/input-editor.js')
@endPushOnce

@push('scripts')
    <script type="module">
        Editores.add({{ Js::from($id) }}, {{ Js::from($options) }})
    </script>
@endPush
