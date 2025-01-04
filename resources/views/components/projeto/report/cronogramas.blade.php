<div class="row g-2 mb-2">
    <x-report.secao titulo="Cronograma de Sprints" class="col-12">
        <x-report.cronograma-sprints :$projeto />
    </x-report.secao>
    <x-report.secao titulo="Cronograma de Releases" class="col-12">
        <x-report.cronograma-releases :$projeto />
    </x-report.secao>
</div>
