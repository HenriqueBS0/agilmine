<div class="row g-2 mb-2 pb-2">
    @foreach ($membros as $membro)
        <x-report.membros-card :$projeto :$membro :$tarefas />
    @endforeach
</div>
