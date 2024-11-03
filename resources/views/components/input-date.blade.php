<div class="{{ $containerClass }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input wire:model{{ isset($event) ? ".$event" : '' }}="{{ $model }}" type="date"
        class="form-control @error($model) is-invalid @enderror" id="{{ $id }}" {{ $attributes }}>
    @error($model)
        <div id="{{ $id }}-feedback" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
