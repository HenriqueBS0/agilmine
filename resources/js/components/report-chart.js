import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import _ from 'lodash';

Chart.register(ChartDataLabels);

class Charts {
    static charts = {};

    /**
     * Processa as opções do gráfico, substituindo variáveis CSS personalizadas.
     * @param {Object} options - Configurações do gráfico.
     * @returns {Object} - Configurações processadas.
     */
    static processOptions(options) {
        return _.cloneDeepWith(options, (value) => {
            if (typeof value === 'string' && value.startsWith('css-var:')) {
                return getComputedStyle(document.documentElement).getPropertyValue(value.replace('css-var:', ''));
            }
        });
    }

    /**
     * Adiciona um novo gráfico.
     * @param {string} id - ID do elemento canvas.
     * @param {Object} options - Configurações do gráfico.
     * @returns {Chart} - Instância do gráfico criado.
     */
    static add(id, options) {
        const chartOptions = this.prepareOptions(id, options);

        // Cria o gráfico e armazena na coleção estática
        const chart = new Chart(
            document.getElementById(id),
            this.processOptions(chartOptions)
        );

        this.charts[id] = chart;
        return chart;
    }

    /**
     * Prepara as opções do gráfico, adicionando configuração de animação.
     * @param {string} id - ID do gráfico.
     * @param {Object} options - Configurações do gráfico.
     * @returns {Object} - Configurações ajustadas.
     */
    static prepareOptions(id, options) {
        if (!options.options) {
            options.options = {};
        }

        if (!options.options.animation) {
            options.options.animation = {};
        }

        // Adiciona o callback para gerar a imagem após a renderização
        options.options.animation.onComplete = () => {
            this.addImage(id);
        };

        return options;
    }

    /**
     * Adiciona uma imagem gerada do gráfico ao container.
     * @param {string} id - ID do gráfico.
     */
    static addImage(id) {
        const chart = this.get(id);

        if (!chart) {
            console.error(`Chart with id "${id}" not found.`);
            return;
        }

        const imageURL = chart.toBase64Image();
        const container = document.getElementById(`${id}-container`);

        if (!container) {
            console.error(`Container with id "${id}-container" not found.`);
            return;
        }

        this.replaceImage(container, imageURL, id);
    }

    /**
     * Substitui a imagem existente no container por uma nova.
     * @param {HTMLElement} container - Container do gráfico.
     * @param {string} imageURL - URL da imagem gerada.
     * @param {string} id - ID do gráfico.
     */
    static replaceImage(container, imageURL, id) {
        const existingImage = container.querySelector('img');

        // Remove a imagem antiga, se existir
        if (existingImage) {
            container.removeChild(existingImage);
        }

        // Cria uma nova imagem
        const img = document.createElement('img');
        img.src = imageURL;
        img.alt = `Imagem do gráfico ${id}`;
        img.style.marginTop = '10px';
        img.style.maxWidth = '100%';

        container.appendChild(img);
    }

    /**
     * Retorna a instância de um gráfico pelo ID.
     * @param {string} id - ID do gráfico.
     * @returns {Chart|null} - Instância do gráfico ou null se não encontrado.
     */
    static get(id) {
        return this.charts[id] || null;
    }
}

// Disponibiliza a classe Charts globalmente
window.Charts = Charts;
