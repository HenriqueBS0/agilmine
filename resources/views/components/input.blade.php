@props(['id', 'type' => 'text', 'monitorErro' => null])

@php
    use Illuminate\View\ComponentAttributeBag;

    // Separando atributos em container e field
    $containerAttributes = [];
    $fieldAttributes = [];

    foreach ($attributes as $key => $value) {
        if (str_starts_with($key, 'container-')) {
            $containerAttributes[str_replace('container-', '', $key)] = $value;
        } else {
            $fieldAttributes[$key] = $value;
        }
    }

    $containerAttributes = (new ComponentAttributeBag($containerAttributes))->merge(['id' => "container-{$id}"]);

    $fieldClasses = $type === 'switch' || $type === 'checkbox' ? 'form-check-input' : 'form-control';

    $fieldAttributes = (new ComponentAttributeBag($fieldAttributes))
        ->class([
            $fieldClasses,
            'is-valid' => isset($feedback) && $feedback->attributes->get('valid', false),
            'is-invalid' =>
                (isset($feedback) && !$feedback->attributes->get('valid', false)) ||
                (!is_null($monitorErro) && $errors->has($monitorErro)),
        ])
        ->merge([
            'id' => $id,
            'aria-describedby' => "feedback-{$id}",
            'type' => $type === 'switch' || $type === 'checkbox' ? 'checkbox' : $type,
        ]);
@endphp

<div {{ $containerAttributes }}>
    @if (in_array($type, ['switch', 'checkbox']))
        <div @class(['form-check', 'form-switch' => $type === 'switch'])>
            <input {{ $fieldAttributes }}>
            @if (isset($label))
                <label {{ $label->attributes->merge(['for' => $id, 'class' => 'form-check-label']) }}>
                    {{ $label }}
                </label>
            @endif

            <x-input-feedback :id="$id" :monitor-erro="$monitorErro" :feedback="$feedback ?? null" />

        </div>
    @else
        @if (isset($label))
            <label {{ $label->attributes->merge(['for' => $id, 'class' => 'form-check-label']) }}>
                {{ $label }}
            </label>
        @endif

        @if ($type === 'textarea')
            <textarea {{ $fieldAttributes }}>{{ $slot }}</textarea>
        @elseif ($type === 'select')
            <select {{ $fieldAttributes->class(['form-select']) }}>
                {{ $select }}
            </select>
        @else
            <input {{ $fieldAttributes }} type="{{ $type }}">
        @endif

        <x-input-feedback :id="$id" :monitor-erro="$monitorErro" :feedback="$feedback ?? null" />
    @endif
</div>
