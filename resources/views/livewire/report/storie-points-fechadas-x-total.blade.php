<canvas x-data="{
    init() {
        new Chart($el, {
            type: 'doughnut',
            data: {
                labels: ['Fechada', 'Não Fechadas'],
                datasets: [{
                    label: 'Quantidade',
                    data: [$wire.fechadas, $wire.naoFechadas],
                    backgroundColor: [
                        getComputedStyle(document.documentElement).getPropertyValue('--bs-destaque'),
                        getComputedStyle(document.documentElement).getPropertyValue('--bs-primary'),
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Storie Points: Fechadas x Não Fechadas',
                        align: 'start',
                        font: { weight: 'bold', size: 16 }
                    }
                }
            }
        })
    }
}"></canvas>
