<div class="{{ $containerClass }}">
    <div class="form-check">
        <input wire:model{{ isset($event) ? ".$event" : '' }}="{{ $model }}"
            class="form-check-input @error($model) is-invalid @enderror" type="checkbox" id="{{ $id }}"
            {{ $attributes }}>
        <label class="form-check-label" for="{{ $id }}">
            {{ $label }}
        </label>
        @error($model)
            <div id="{{ $id }}-feedback" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
