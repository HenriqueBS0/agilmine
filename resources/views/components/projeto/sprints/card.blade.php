<div class="card">
    <div class="card-header" style="background-color: {{ $corFundo }}; color: {{ $corTexto }}">
        {{ $tipo }}: {{ $status->getDescricao() }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Sprint {{ $sprint->serial }} - {{ $sprint->nome }}</h5>
        <p class="card-text">
            <strong>Período:</strong> {{ $sprint->data_inicio->format('d/m/Y') }} -
            {{ $sprint->data_fim->format('d/m/Y') }}<br>
            <strong>Versão:</strong> {{ is_null($versao) ? '' : $versao->getNome() }}<br>
            <strong>Tarefas Fechadas/Total:</strong> {{ $totalTarefasFechadas }}/{{ $totalTarefas }}<br>
            <strong>Resumo:</strong> {{ $sprint->resumo }}<br>
            @if ($sprint->gera_release)
                <strong>Resumo Release:</strong> {{ $sprint->resumo_release }}<br>
            @endif


        </p>
        @if ($status->isEmAndamento())
            <div class="progress" style="height: 20px; margin: 16px 0;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="background-color: {{ $corFundo }}; color: {{ $corTexto }}; width: {{ $proporcaoFeita }}%;"
                    aria-valuenow="{{ $proporcaoFeita }}" aria-valuemin="0" aria-valuemax="100">{{ $proporcaoFeita }}%
                </div>
            </div>
        @endif
    </div>
    @if (!($status->isCancelada() && Gate::denies('isGestor', $sprint->projeto)))
        <div class="card-footer">
            @if ($status->isCancelada())
                @can('isGestor', $sprint->projeto)
                    <button class="btn btn-secondary" wire:click="restaurar({{ $sprint->id }})">Restaurar</button>
                @endcan
            @else
                <a href="{{ route('pagina-sprint-report', ['sprint' => $sprint]) }}" class="btn"
                    style="background-color: {{ $corFundo }}; color: {{ $corTexto }}; border-color: {{ $corBorda }}">
                    Acessar
                </a>
                @can('isGestor', $sprint->projeto)
                    <button class="btn btn-secondary" wire:click="cancelar({{ $sprint->id }})">Cancelar</button>
                @endcan
            @endif
        </div>
    @endif
</div>
