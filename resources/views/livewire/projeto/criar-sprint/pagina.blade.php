<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main class="container">
    <div class="row">
        <div class="col-12">
            <x-sprint.form titulo="Criar Sprint" :vercoes="$vercoes"
                cancelar="{{ route('pagina-projeto-sprints', $projeto) }}" />
        </div>
    </div>
</x-main>
