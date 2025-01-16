<x-report.secao @class([
    'col-4',
    'order-1' => $numeroTarefas > 0,
    'order-2' => $numeroTarefas <= 0,
])>
    <x-slot:content>
        <div class="card h-100">
            <div class="card-header" @style([
                'background: var(--bs-destaque-bg-subtle); color: var(--bs-destaque-text-emphasis);' => $numeroTarefas > 0,
                'background: var(--bs-primary-bg-subtle); color: var(--bs-primary-text-emphasis);' => $numeroTarefas <= 0,
            ])>
                <h5 class="card-title">Membro: {{ $membro->getUsuario()->getNome() }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush text-bg-light">
                    <li class="list-group-item">
                        <strong>Tarefas:</strong> Total: <strong
                            style="color: var(--bs-primary-text-emphasis);">{{ $numeroTarefas }}</strong>, Fechadas:
                        <strong style="color: var(--bs-destaque-text-emphasis);">{{ $numeroTarefasFechadas }}</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>Perfís:</strong> {{ $membro->perfisToString() }}
                    </li>
                    @can('isMetricaHorasAtiva', $projeto)
                        <li class="list-group-item">
                            <strong>Horas:</strong> Estimadas: <strong
                                style="color: var(--bs-primary-text-emphasis);">{{ $horasEstimadas }}</strong>, Gastas:
                            <strong style="color: var(--bs-destaque-text-emphasis);">{{ $horasGastas }}</strong>
                        </li>
                    @endcan
                    @can('isMetricaStoryPointsAtiva', $projeto)
                        <li class="list-group-item">
                            <strong>Story Points:</strong> Total: <strong
                                style="color: var(--bs-primary-text-emphasis);">{{ $storyPoints }}</strong>, Fechadas:
                            <strong style="color: var(--bs-destaque-text-emphasis);">{{ $storyPointsFechadas }}</strong>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </x-slot:content>
</x-report.secao>
