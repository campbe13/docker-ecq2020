#!/bin/bash
# sample db init 
# just for the trial

set -e  # exit if cmd has non zero status

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE USER docker;
    CREATE DATABASE docker;
    GRANT ALL PRIVILEGES ON DATABASE docker TO docker;
    GRANT ALL PRIVILEGES ON DATABASE wordcount_dev TO docker;
EOSQL

