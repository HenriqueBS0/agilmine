@props([
    'id',
    'titulo' => null,
    'mensagem' => null,
    'confirmarTexto' => 'Confirmar',
    'cancelarTexto' => 'Cancelar',
    'confirmarClass' => 'btn btn-primary',
    'cancelarClass' => 'btn btn-secondary',
    'onConfirm' => null,
])

<x-modal :id="$id" :titulo="$titulo" :mensagem="$mensagem" :headerFechar="false">
    <x-slot:footer>
        <x-modal-footer :fechar="false">
            @if (isset($confirm))
                <button
                    {{ $confirm->attributes->merge(['type' => 'button', 'class' => 'btn btn-primary']) }}>{{ $confirm }}</button>
            @else
                <button type="button" class="{{ $confirmarClass }}" data-bs-dismiss="modal"
                    @if ($onConfirm) onclick="{{ $onConfirm }}" @endif>
                    {{ $confirmarTexto }}
                </button>
            @endif
            <x-modal-button-close class="{{ $cancelarClass }}" :modal-id="$id">
                {{ $cancelarTexto }}
            </x-modal-button-close>
        </x-modal-footer>
    </x-slot:footer>
</x-modal>
