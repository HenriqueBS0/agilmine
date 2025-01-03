<div class="row g-2 mb-2">
    <x-report.secao titulo="Dias Restantes" class="col-2">
        <x-report.dias-restantes :pequeno="false" :$sprint />
    </x-report.secao>
    <x-report.secao titulo="Tarefas Restantes" class="col-2">
        <x-report.tarefas-restantes :pequeno="false" :$tarefas />
    </x-report.secao>
    @can('isMetricaStoryPointsAtiva', $sprint)
        <x-report.secao titulo="Velocidade" class="col-2">
            <x-report.velocidade :$sprint :$tarefas :pequeno="false"></x-report.velocidade>
        </x-report.secao>
        <x-report.secao titulo="Velocidade Média/Dia" class="col-3">
            <x-report.velocidade-media :$sprint :$tarefas :pequeno="false" />
        </x-report.secao>
    @endcan
    @can('isMetricaHorasAtiva', $sprint)
        <x-report.secao titulo="Tempo Estimado Restante" class="col-3">
            <x-report.tempo-estimado-restante :$tarefas :pequeno="false" />
        </x-report.secao>
    @endcan
</div>

<div class="row g-2 mb-2">
    <x-report.secao titulo="BurnDown" class="col-6">
        <x-report.burn-down id="burn-down" :$sprint :$tarefas />
    </x-report.secao>
    <x-report.secao titulo="BurnUp" class="col-6">
        <x-report.burn-up id="burn-up" :$sprint :$tarefas />
    </x-report.secao>
</div>

<div class="row g-2 mb-2">
    @can('isMetricaHorasAtiva', $sprint)
        <x-report.secao titulo="Tempo (Horas) Gasto x Estimado" class="col-4">
            <x-report.tempo-estimado-tempo-gasto id="tempo-gasto-estimado" :$tarefas />
        </x-report.secao>
    @endcan
    <x-report.secao titulo="Tarefas Fechadas x Abertas" class="col-2">
        <x-report.tarefas-fechadas-abertas id="fechadas-abertas" :$tarefas />
    </x-report.secao>
    @can('isMetricaStoryPointsAtiva', $sprint)
        <x-report.secao titulo="Story Points Fechadas x Abertas" class="col-2">
            <x-report.story-points-tarefas-fechadas-abertas id="story-points-fechadas-abertas" :$tarefas />
        </x-report.secao>
    @endcan
    @can('isMetricaHorasAtiva', $sprint)
        <x-report.secao titulo="Tempo Gasto Fechadas x Abertas" class="col-2">
            <x-report.tempo-gasto-fechadas-abertas id="tempo-gasto-fechadas-abertas" :$tarefas />
        </x-report.secao>
        <x-report.secao titulo="Tempo Estimado Fechadas x Abertas" class="col-2">
            <x-report.tempo-estimado-fechadas-abertas id="tempo-estimado-fechadas-abertas" :$tarefas />
        </x-report.secao>
    @endcan
</div>
