<div class="row g-2 mb-2">
    @can('isMetricaHorasAtiva', $projeto)
        <x-report.secao titulo="Tempo (Horas) Gasto x Estimado" class="col-6">
            <x-report.tempo-estimado-tempo-gasto id="tempo-estimado-tempo-gasto" :pequeno="false" :$sprints :$tarefas />
        </x-report.secao>
    @endcan
    @can('isMetricaStoryPointsAtiva', $projeto)
        <x-report.secao titulo="Velocidade Média/Semana Sprints" class="col-6">
            <x-report.velocidade-media-sprints id="velocidade-media-sprints" :pequeno="false" :$sprints :$tarefas />
        </x-report.secao>
    @endcan
    <x-report.secao titulo="Tarefas Fechadas x Abertas" class="col-3">
        <x-report.tarefas-fechadas-abertas id="fechadas-abertas" :$tarefas />
    </x-report.secao>
    @can('isMetricaStoryPointsAtiva', $projeto)
        <x-report.secao titulo="Story Points Fechadas x Abertas" class="col-3">
            <x-report.story-points-tarefas-fechadas-abertas id="story-points-fechadas-abertas" :$tarefas />
        </x-report.secao>
    @endcan
    @can('isMetricaHorasAtiva', $projeto)
        <x-report.secao titulo="Tempo Gasto Fechadas x Abertas" class="col-3">
            <x-report.tempo-gasto-fechadas-abertas id="tempo-gasto-fechadas-abertas" :$tarefas />
        </x-report.secao>
        <x-report.secao titulo="Tempo Estimado Fechadas x Abertas" class="col-3">
            <x-report.tempo-estimado-fechadas-abertas id="tempo-estimado-fechadas-abertas" :$tarefas />
        </x-report.secao>
    @endcan
</div>
