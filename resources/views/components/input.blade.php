@props(['id', 'monitorErro' => null])

@php
    use Illuminate\View\ComponentAttributeBag;

    $containerAttributes = [];
    $inputAttributes = [];

    foreach ($attributes as $key => $value) {
        if (str_starts_with($key, 'container-')) {
            $containerAttributes[str_replace('container-', '', $key)] = $value;
        } else {
            $inputAttributes[$key] = $value;
        }
    }

    $containerAttributes = (new ComponentAttributeBag($containerAttributes))->merge(['id' => "container-{$id}"]);

    $inputAttributes = (new ComponentAttributeBag($inputAttributes))
        ->class([
            'form-control',
            'is-valid' => isset($feedback) && $feedback->attributes->get('valid', false),
            'is-invalid' =>
                (isset($feedback) && !$feedback->attributes->get('valid', false)) ||
                (!is_null($monitorErro) && $errors->has($monitorErro)),
        ])
        ->merge([
            'id' => $id,
            'aria-describedby' => "feedback-{$id}",
        ]);
@endphp


<div {{ $containerAttributes }}>
    @if (isset($label))
        <label {{ $label->attributes->merge(['for' => $id, 'class' => 'form-label']) }}>{{ $label }}</label>
    @endif
    <input {{ $inputAttributes }}>


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
            <div id={{ "feedback-{$id}" }} class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endif

</div>
