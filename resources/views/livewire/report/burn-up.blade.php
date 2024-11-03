<canvas x-data="{
    init() {
        new Chart($el, {
            type: 'line',
            data: {
                labels: $wire.tarefasConcluidas.map(dados => dados.data),
                datasets: [{
                        label: 'Realizado',
                        data: $wire.tarefasConcluidas.map(dados => dados.quantidade),
                        fill: false,
                        borderColor: getComputedStyle(document.documentElement).getPropertyValue('--bs-destaque'),
                        tension: 0.1
                    },
                    {
                        label: 'Estimado',
                        data: $wire.tarefasConcluidas.map(dados => dados.quantidadeEstimada),
                        fill: false,
                        borderColor: getComputedStyle(document.documentElement).getPropertyValue('--bs-primary'),
                        tension: 0.1
                    }
                ]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Burnup',
                        align: 'start',
                        font: { weight: 'bold', size: 16 }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Data',
                            font: { size: 12 }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Tarefas concluídas',
                            font: { size: 12 }
                        }
                    }
                }
            }
        })
    }
}"></canvas>
