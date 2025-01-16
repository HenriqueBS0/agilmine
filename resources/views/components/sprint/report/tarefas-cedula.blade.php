@props(['tarefa'])

<td scope="col" @style([
    'background-color: var(--bs-destaque-bg-subtle);' => $tarefa->getStatus()?->getFechada(),
])>{{ $slot }}</td>
