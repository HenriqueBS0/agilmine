<div class="row g-2 mb-2">
    @can('isMetricaHorasAtiva', $projeto)
        <x-report.secao titulo="Horas Estimadas" class="col-2">
            <x-report.horas-estimadas :pequeno="false" :$tarefas />
        </x-report.secao>
        <x-report.secao titulo="Horas Trabalhas" class="col-2">
            <x-report.horas-trabalhadas :pequeno="false" :$tarefas />
        </x-report.secao>
    @endcan
    <x-report.secao titulo="Sprints" class="col-2">
        <x-report.sprints-projetos :pequeno="false" :projetos="[$projeto]" />
    </x-report.secao>
    <x-report.secao titulo="Sprints Concluidas" class="col-2">
        <x-report.sprints-concluidas-projetos :pequeno="false" :projetos="[$projeto]" :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Sprints Em Andamento" class="col-2">
        <x-report.sprints-em-andamento-projetos :pequeno="false" :projetos="[$projeto]" :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Releases" class="col-2">
        <x-report.releases-projetos :pequeno="false" :projetos="[$projeto]" :$tarefas />
    </x-report.secao>
</div>
