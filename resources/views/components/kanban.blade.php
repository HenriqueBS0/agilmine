<div class="row flex-grow-1 h-100 overflow-auto">
    <x-kanban-coluna :tarefas="$aberta">
        <x-slot:header class="text-bg-destaque">Aberta</x-slot:header>
    </x-kanban-coluna>
    <x-kanban-coluna :tarefas="$desenvolvimento">
        <x-slot:header class="text-bg-primary">Desenvolvimento</x-slot:header>
    </x-kanban-coluna>
    <x-kanban-coluna :tarefas="$aprovacao">
        <x-slot:header class="text-bg-info">Aprovação</x-slot:header>
    </x-kanban-coluna>
    <x-kanban-coluna :tarefas="$cancelada">
        <x-slot:header class="text-bg-warning">Cancelada</x-slot:header>
    </x-kanban-coluna>
    <x-kanban-coluna :tarefas="$fechada">
        <x-slot:header class="text-bg-success">Fechada</x-slot:header>
    </x-kanban-coluna>
</div>
