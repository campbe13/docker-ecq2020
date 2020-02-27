# dockerfile for mysql
# 2020-2-23

FROM mysql:latest
MAINTAINER P Campbell pcampbell.edu@gmail.com

# environment variables 
ENV MYSQL_DATABASE=stickynotes \
	MYSQL_ROOT_PASSWORD=ecq2020

# copy the db dump file to seed the db
COPY ./dbsetup.sql /docker-entrypoint-initdb.d

# expose mysql port
EXPOSE 3306
