<div x-data="{ confirmacao: '', isInvalid: false }" x-init="const modal = document.getElementById('{{ $id }}');
modal.addEventListener('show.bs.modal', () => {
    confirmacao = '';
    isInvalid = '';
});" class="modal fade" id="{{ $id }}" aria-hidden="true"
    aria-labelledby="{{ $id }}-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $id }}-label">Excluir sprint {{ $sprint->serial }} -
                    {{ $sprint->nome }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <label for="confirmacao" class="form-label">
                        <strong>Para confirmar, informe "{{ $sprint->nome }}"</strong>
                    </label>
                    <input type="text" x-model="confirmacao"
                        @input="isInvalid = confirmacao !== '{{ $sprint->nome }}'"
                        @blur="isInvalid = confirmacao !== '{{ $sprint->nome }}'" :class="{ 'is-invalid': isInvalid }"
                        class="form-control" id="confirmacao" autocomplete="off">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger w-100" wire:click='excluir'
                    :disabled="confirmacao !== '{{ $sprint->nome }}'">
                    Excluir essa sprint
                </button>
            </div>
        </div>
    </div>
</div>
