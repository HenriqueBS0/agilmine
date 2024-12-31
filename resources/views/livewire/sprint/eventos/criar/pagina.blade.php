<x-slot:navbar>
    <x-sprint.navbar :$sprint />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :$sprint />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main titulo="Criar Evento" class="container">
    <div class="row">
        <div class="col-12">
            <x-sprint.eventos.form :form="$form" :$sprint titulo="Criar Evento" :cancelar="route('pagina-sprint-eventos', ['sprint' => $sprint])" />
        </div>
    </div>
</x-main>
