#!/bin/bash
mysql -u root -p$MYSQL_ROOT_PASSWORD agilmine < /docker-entrypoint-initdb.d/backup.sql