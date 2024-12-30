<x-slot:navbar>
    <x-sprint.navbar :sprint="$sprint" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-sprint.sidebar :sprint="$sprint" />
</x-slot:sidebar>
<x-main>
    <x-kanban :tarefas="$tarefas"></x-kanban>
</x-main>
