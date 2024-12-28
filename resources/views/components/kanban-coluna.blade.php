@props(['tarefas'])

<div {{ $attributes->class(['col h-100']) }}>
    <div class="card h-100 ">
        <div {{ $header->attributes->class(['card-header']) }}>
            {{ $header }}
            <span class="badge bg-secondary float-end">{{ count($tarefas) }}</span>
        </div>
        <div class="card-body h-100 overflow-auto">
            @foreach ($tarefas as $tarefa)
                <x-kanban-tarefa :tarefa="$tarefa" />
            @endforeach
        </div>
    </div>
</div>
