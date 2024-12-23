@props(['id', 'titulo' => null, 'headerFechar' => true, 'dialogClass' => '', 'mensagem' => null])

<div {{ $attributes->class(['modal'])->merge([
    'id' => $id,
    'tabindex' => '-1',
    'data-bs-backdrop' => 'static',
    'data-bs-keyboard' => 'false',
    'aria-hidden' => 'true',
    'aria-labelledby' => "{$id}Label",
]) }}
    wire:ignore.self>
    <div class="modal-dialog {{ $dialogClass }}">
        <div class="modal-content">
            @if (isset($header))
                {{ $header }}
            @elseif (is_string($titulo))
                <x-modal-header :modal-id="$id" :titulo="$titulo" :fechar="$headerFechar" />
            @endif
            <div class="modal-body">
                @if (!is_null($mensagem))
                    <p>{{ $mensagem }}</p>
                @else
                    {{ $slot }}
                @endif
            </div>
            @if (isset($footer))
                {{ $footer }}
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const myModal = new bootstrap.Modal(document.getElementById('{{ $id }}'));

        Livewire.on('abrir-modal', event => {
            if ('{{ $id }}' === event.id) {
                myModal.show();
            }
        });
        Livewire.on('fechar-modal', (event) => {
            if ('{{ $id }}' === event.id) {
                myModal.hide();
            }
        });
    });
</script>
