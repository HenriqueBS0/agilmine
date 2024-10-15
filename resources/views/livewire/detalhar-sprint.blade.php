<x-slot name="navbar">
    <livewire:navbar :$navbarBreadCrumbItens></livewire:navbar>
</x-slot>

<div class="container-fluid">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-6">
            <canvas id="burn-down"></canvas>
        </div>
        <div class="col-6">
            <canvas id="burn-up"></canvas>
        </div>
    </div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
        new Chart(document.getElementById('burn-down'), $wire.configuracaoBurnDown);
        new Chart(document.getElementById('burn-up'), $wire.configuracaoBurnUp);
    </script>
@endscript
