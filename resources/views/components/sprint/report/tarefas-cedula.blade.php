@props(['tarefa'])

<td scope="col" @class([
    'table-secondary' => $tarefa->getStatus()?->getFechada(),
])>{{ $slot }}</td>
