<div class="row g-2 mb-2">
    @foreach ($eventos as $evento)
        <x-report.secao :no-break="false" :titulo="$evento->tipo->getDescricao() .
            ' - ' .
            $evento->data_hora->format('d/m/Y') .
            ' às ' .
            $evento->data_hora->format('H:i') .
            ' horas'" class="col-12">
            <p class="card-text">
                <strong>Participantes:</strong> {{ $getParticipantes($evento->participantes) }}
            </p>
            {!! $evento->descricao !!}
        </x-report.secao>
    @endforeach
</div>
