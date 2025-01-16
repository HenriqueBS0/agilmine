@props(['titulo', 'content', 'card' => null, 'body' => null, 'title' => null, 'noBreak' => true])

<div {{ $attributes->class(['no-break' => $noBreak]) }}>
    @if (isset($content))
        {{ $content }}
    @else
        <div {{ $card?->attributes->class(['card']) }} @class(['card' => !$card])>
            <div {{ $body?->attributes->class(['card-body']) }} @class(['card-body' => !$body])>
                <h5 {{ $title?->attributes->class(['card-title']) }} @class(['card-title' => !$title])>
                    {{ $titulo }}
                </h5>
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

@pushOnce('estilos')
    <style>
        @media print {
            .no-break {
                page-break-inside: avoid;
                /* Evita quebras dentro do elemento */
                page-break-before: auto;
                /* Define automaticamente onde começar */
                page-break-after: auto;
                /* Define automaticamente onde terminar */
                break-inside: avoid;
                /* Compatível com navegadores modernos */
            }
        }
    </style>
@endpushonce
