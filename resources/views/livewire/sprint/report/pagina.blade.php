<x-slot:navbar>
    <x-sprint.navbar :sprint="$sprint" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :sprint="$sprint" />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main titulo="Report">
    <x-slot:acoes>
        <button class="btn btn-primary" id="download">
            <span>Baixar</span>
            <i class="bi bi-file-arrow-down"></i>
        </button>
    </x-slot:acoes>
    <div id="report">
        <x-sprint.report.eventos :$sprint :$membros />
        <x-sprint.report.tarefas :$tarefas />
        <x-sprint.report.metricas :$sprint :$tarefas />
        @can('isMetricaMembroAtiva', $sprint)
            <x-sprint.report.membros :$sprint :$tarefas :$membros />
        @endcan
    </div>
</x-main>

@pushOnce('estilos')
    <style>
        @media print {
            body * {
                visibility: hidden;
                /* Oculta todos os elementos */
            }

            #report,
            #report * {
                visibility: visible;
                /* Torna visível apenas o elemento específico */
            }

            #report {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>
@endpushonce

@vite('resources/js/components/sprint-report.js')
