# populate a db with a database
# use bind mount to have the database in the current working directory ./db

FROM mysql

ENV MYSQL_ROOT_PASSWORD=secret

ENV MYSQL_USER=dbuser
ENV MYSQL_PASSWORD=secret
ENV MYSQL_DATABASE=pets

WORKDIR /docker-entrypoint
