#!/bin/bash

psql -U postgres -d redmine -c "DROP SCHEMA public CASCADE; CREATE SCHEMA public;"

psql -U postgres -d redmine < /docker-entrypoint-initdb.d/backup.sql