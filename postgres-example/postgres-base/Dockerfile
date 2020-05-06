# PMC 2020-05-05
# use a base image of postgres https://hub.docker.com/_/postgres

FROM postgres

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" info="testing postgres base"

ENV POSTGRES_PASSWORD secret
# default user ENV POSTGRES_USER postgres
# default db created 
ENV POSTGRES_DB wordcount_dev
# args to postgres initdb, note md5 is the default
ENV POSTGRES_INITDB_ARGS md5
# used in echo "host all all all $POSTGRES_HOST_AUTH_METHOD" >> pg_hba.conf
# trust is no password
# ENV POSTGRES_HOST_AUTH_METHOD
# location for db files, default /var/lib/postgresql/data.
# ENV PGDATA

# if you want to have a script populate a db on startup
# n.b. run ONLY if the data directory is empty
COPY initsample.sh /docker-entrypoint-initdb.d/

# And add ``listen_addresses`` to ``/etc/postgresql/main/postgresql.conf``
RUN echo "listen_addresses='*'" >>  /etc/postgresql/postgresql.conf

# Expose the PostgreSQL port
EXPOSE 5432

# Add VOLUMEs to allow backup of config, logs and databases
# VOLUME  ["/etc/postgresql", "/var/log/postgresql", "/var/lib/postgresql"]

# Set the default command to run when starting the container
ENTRYPOINT ["su", "-", "postgres", "-c", "postgres" ]
# ENTRYPOINT ["postgres", "-D", "/var/lib/postgresql/9.3/main", "-c", "config_file=/etc/postgresql/9.3/main/postgresql.conf"]
