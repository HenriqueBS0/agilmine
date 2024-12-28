@props(['id', 'feedback' => null, 'monitorErro' => null])

@if (isset($feedback) && is_null($monitorErro))
    <div
        {{ $feedback->attributes->class([
                'valid-feedback' => $feedback->attributes->get('valid', false),
                'invalid-feedback' => !$feedback->attributes->get('valid', false),
            ])->merge([
                'id' => "feedback-{$id}",
            ]) }}>
        {{ $feedback }}
    </div>
@elseif (!is_null($monitorErro))
    @error($monitorErro)
        <div id="feedback-{{ $id }}" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
@endif
