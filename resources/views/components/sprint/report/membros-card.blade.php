<x-report.secao titulo="Membro: {{ $membro->getUsuario()->getNome() }}" class="col-3">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Tarefas:</strong> Total: <strong
                style="color: var(--bs-primary-text-emphasis);">{{ $numeroTarefas }}</strong>, Fechadas: <strong
                style="color: var(--bs-destaque-text-emphasis);">{{ $numeroTarefasFechadas }}</strong>
        </li>
        @can('isMetricaHorasAtiva', $sprint)
            <li class="list-group-item">
                <strong>Horas:</strong> Estimadas: <strong
                    style="color: var(--bs-primary-text-emphasis);">{{ $horasEstimadas }}</strong>, Gastas: <strong
                    style="color: var(--bs-destaque-text-emphasis);">{{ $horasGastas }}</strong>
            </li>
        @endcan
        @can('isMetricaStoryPointsAtiva', $sprint)
            <li class="list-group-item">
                <strong>Story Points:</strong> Total: <strong
                    style="color: var(--bs-primary-text-emphasis);">{{ $storyPoints }}</strong>, Fechadas:
                <strong style="color: var(--bs-destaque-text-emphasis);">{{ $storyPointsFechadas }}</strong>
            </li>
        @endcan
    </ul>
</x-report.secao>
