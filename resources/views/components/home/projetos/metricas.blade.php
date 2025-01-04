<div class="row g-2 mb-5">
    <x-report.secao titulo="Projetos" class="col-1">
        <x-report.projetos :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Horas Estimasdas" class="col-2">
        <x-report.horas-estimadas :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Horas Trabalhas" class="col-2">
        <x-report.horas-trabalhadas :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Sprints" class="col-2">
        <x-report.sprints-projetos :pequeno="false" :$projetos />
    </x-report.secao>
    <x-report.secao titulo="Sprints Concluidas" class="col-2">
        <x-report.sprints-concluidas-projetos :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Sprints Em Andamento" class="col-2">
        <x-report.sprints-em-andamento-projetos :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="Releases" class="col-1">
        <x-report.releases-projetos :pequeno="false" :$projetos :$tarefas />
    </x-report.secao>
</div>
