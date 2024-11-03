<x-slot:navbar>
    <livewire:pagina-sprint-navbar :$projeto :$sprint atual="{{ $sprint->nome }}" />
</x-slot:navbar>
<x-slot:sidebar>
    <livewire:pagina-sprint-sidebar :$projeto :$sprint atual="Report" />
</x-slot:sidebar>
<main class="container p-3">
    <div class="row">
        <div class="col d-flex">
            <h3>Report</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-6"><livewire:report.burn-down :$sprint :$tarefas /></div>
        <div class="col-6"><livewire:report.burn-up :$sprint :$tarefas /></div>
        <div class="col-6"><livewire:report.tempo-estimado-x-gasto :$tarefas /></div>
        <div class="col-3"><livewire:report.tarefas-fechadas-x-total :$tarefas /></div>
        <div class="col-3"><livewire:report.storie-points-fechadas-x-total :$tarefas /></div>
    </div>
</main>
