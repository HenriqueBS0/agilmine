<div>
    @can('isMetricaHorasAtiva', $projeto)
        <x-report.horas-estimadas :$tarefas />
        <x-report.horas-trabalhadas :$tarefas />
    @endcan
    <x-report.sprints-projetos :projetos="[$projeto]" />
    <x-report.sprints-concluidas-projetos :projetos="[$projeto]" :$tarefas />
    <x-report.sprints-em-andamento-projetos :projetos="[$projeto]" :$tarefas />
    <x-report.releases-projetos :projetos="[$projeto]" :$tarefas />
</div>
