#!/bin/bash
set -e

# Verifica se o banco já foi restaurado
if [ ! -f /var/lib/postgresql/data/.restore_completed ]; then
    echo "Restaurando o banco de dados a partir do backup..."
    pg_restore -U postgres -d redmine /docker-entrypoint-initdb.d/backup.dump
    touch /var/lib/postgresql/data/.restore_completed
    echo "Restauração concluída."
else
    echo "Banco de dados já restaurado, ignorando."
fi