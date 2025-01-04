<div class="row g-2 mb-2">
    @can('isMetricaHorasAtiva', $projeto)
        <x-report.secao titulo="Horas Estimasdas" class="col-2">
            <x-report.horas-estimadas :pequeno="false" :$tarefas />
        </x-report.secao>
        <x-report.secao titulo="Horas Trabalhas" class="col-2">
            <x-report.horas-trabalhadas :pequeno="false" :$tarefas />
        </x-report.secao>
    @endcan
    <x-report.secao titulo="Sprints" class="col-2">
        <x-report.sprints-projeto :pequeno="false" :$projeto />
    </x-report.secao>
    <x-report.secao titulo="Sprints Concluidas" class="col-2">
        <x-report.sprints-concluidas-projeto :pequeno="false" :$projeto :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Sprints Em Andamento" class="col-2">
        <x-report.sprints-em-andamento-projeto :pequeno="false" :$projeto :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Releases" class="col-2">
        <x-report.releases-projeto :pequeno="false" :$projeto :$tarefas />
    </x-report.secao>
</div>
