<div class="{{ $containerClass }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea wire:model{{ isset($event) ? ".$event" : '' }}="{{ $model }}"
        class="form-control @error($model) is-invalid @enderror" id="{{ $id }}" {{ $attributes }}></textarea>
    @error($model)
        <div id="{{ $id }}-feedback" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
