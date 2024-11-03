<canvas x-data="{
    init() {
        new Chart($el, {
            type: 'bar',
            data: {
                labels: ['Número de horas'],
                datasets: [{
                        label: 'Estimadas',
                        data: [$wire.estimado],
                        backgroundColor: [
                            getComputedStyle(document.documentElement).getPropertyValue('--bs-primary-bg-subtle')
                        ],
                        borderColor: [
                            getComputedStyle(document.documentElement).getPropertyValue('--bs-primary')
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Gastas',
                        data: [$wire.gasto],
                        backgroundColor: [
                            getComputedStyle(document.documentElement).getPropertyValue('--bs-destaque-bg-subtle')
                        ],
                        borderColor: [
                            getComputedStyle(document.documentElement).getPropertyValue('--bs-destaque')
                        ],
                        borderWidth: 1
                    }
                ]


            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Tempo Estimado x Tempo Gasto',
                        align: 'start',
                        font: { weight: 'bold', size: 16 }
                    }
                }
            }
        })
    }
}"></canvas>
