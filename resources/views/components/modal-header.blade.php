@props(['modalId', 'titulo' => false, 'fechar' => true])

<div class="modal-header">
    <h5 class="modal-title" id="{{ "{$modalId}Label" }}">{{ $titulo }}</h5>
    @if (isset($botaoFechar))
        {{ $botaoFechar }}
    @elseif ($fechar)
        <x-modal-button-close :modal-id="$modalId" class="btn-close"></x-modal-button-close>
    @endif
</div>
