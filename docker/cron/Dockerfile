# Usar uma imagem base pequena (Debian slim ou Alpine)
FROM debian:bullseye-slim

# Instalar cron, bash e cliente Docker
RUN apt-get update && apt-get install -y cron bash curl && apt-get clean && \
    curl -fsSL https://get.docker.com | sh

# Criar o arquivo de cronjobs
COPY ./cronjobs /etc/cron.d/cron-tasks

# Aplicar permissões ao arquivo de cron
RUN chmod 0644 /etc/cron.d/cron-tasks && \
    crontab /etc/cron.d/cron-tasks

# Iniciar o cron em modo foreground
CMD ["cron", "-f"]