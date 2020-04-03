# Using The Docker platform

These are overview documents with accumulated examples of components of the docker platform.
Dockerfiles, docker-compose.yaml files etc.

## my registry account
* [tricia](http://hub.docker.com/u/tricia)
## docker commands
* [using docker commands](DOCKERCMDS.md)  runtime output 
## docker-compose commands
* [using docker-compose commands](DOCKERCOMPOSECMDS.md) runtime output

### mysql instance, no Dockerfile, no yaml
* Use this for [demos](MYSQLDEMO.md)
* [running a db from docker hub](MYSQL-INSTANCE.md) runtime output, see also the [launch script](standalone-mysql.sh) and the [sql script](quickdb.sql) to populate the db

## Dockerfile (used with docker commands)
* from [shakespeare container](../shakespeare-ec/Dockerfile.md)
* [Dockerfile used for one of the containers](Dockerfile-redis-shakespeare.md)

## docker-compose.yaml (used with docker-compose commands)
Examples from the [stickynotes containers](../stickynotes-jb) 

* [docker compose yaml file](docker-compose.yaml-stickynotes.md)
    * [Dockerfile used for one of the containers](Dockerfile-used-with-compose-stickynotes.md)
* [makefile used to build this app](Makefile-stickynotes.md) 
