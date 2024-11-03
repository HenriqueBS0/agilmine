@props(['containerClass', 'id', 'label', 'model', 'options', 'selecioneText' => ''])

<div class="{{ $containerClass ?? '' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select wire:model{{ isset($event) ? ".$event" : '' }}="{{ $model }}"
        class="form-select @error($model) is-invalid @enderror" id="{{ $id }}"
        aria-describedby="{{ $id }}-feedback" {{ $attributes }}>
        <option>{{ $selecioneText }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['valor'] }}">{{ $option['descricao'] }}</option>
        @endforeach
    </select>
    @error($model)
        <div id="{{ $id }}-feedback" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
