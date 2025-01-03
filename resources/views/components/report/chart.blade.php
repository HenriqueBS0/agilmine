<div id="{{ $id }}-container" class="chart-container">
    <canvas id="{{ $id }}"></canvas>
</div>

@pushOnce('estilos')
    <style>
        /* Em tela, apenas o canvas é visível */
        .chart-container canvas {
            display: block;
        }

        .chart-container img {
            display: none;
        }

        /* Para impressão, apenas a imagem é visível */
        @media print {
            .chart-container canvas {
                display: none !important;
            }

            .chart-container img {
                display: block !important;
            }
        }
    </style>
@endPushOnce

@pushOnce('scripts')
    @vite('resources/js/components/report-chart.js')
@endPushOnce

@push('scripts')
    <script type="module">
        Charts.add({{ Js::from($id) }}, {{ Js::from($options) }})
    </script>
@endPush
