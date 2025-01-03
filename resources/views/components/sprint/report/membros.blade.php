<div class="row g-2 mb-2 pb-2">
    @foreach ($membros as $membro)
        <x-sprint.report.membros-card :$sprint :$membro :$tarefas />
    @endforeach
</div>
