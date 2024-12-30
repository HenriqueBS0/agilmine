<x-slot:navbar>
    <x-sprint.navbar :$sprint />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :$sprint />
</x-slot:sidebar>
<x-slot:main class="bg-light"></x-slot:main>
<x-main class="container">
    <div class="row">
        <div class="col-12">
            <x-sprint.form titulo="Sprint" :vercoes="$vercoes" :is-gestor="Gate::allows('isGestor', $sprint)" />
        </div>
    </div>
</x-main>
