<x-slot:navbar>
    <x-projeto.navbar :$projeto />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :$projeto />
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
        <x-projeto.report.resumo :$projeto />
        <x-projeto.report.geral :$projeto :$tarefas />
        <x-projeto.report.cronogramas :$projeto :$tarefas />
        <x-projeto.report.metricas :$projeto :$tarefas />
        @can('isMetricaMembroAtiva', $projeto)
            <x-report.membros :$projeto :$tarefas :$membros />
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
@script
    <script>
        document.getElementById('download').addEventListener('click', () => {
            window.print();
        });
    </script>
@endscript
