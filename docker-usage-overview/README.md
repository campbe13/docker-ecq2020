# Using The Docker platform

These are overview documents with accumulated examples of components of the docker platform.
Dockerfiles, docker-compose.yaml files etc.

## my docker hub registry account
* [tricia](http://hub.docker.com/u/tricia)
## docker commands  running and building containers 
* [using docker commands](DOCKERCMDS.md)  runtime output 
## docker-compose commands running and building multi app containers
* [using docker-compose commands](DOCKERCOMPOSECMDS.md) runtime output

### mysql instance, no Dockerfile, no yaml
* See [mysql example](../mysql-example)

## Dockerfile (used with docker commands)
* from [shakespeare container](../shakespeare-ec/Dockerfile.md)
* [Dockerfile used for one of the containers](Dockerfile-redis-shakespeare.md)

## docker-compose.yaml (used with docker-compose commands)
Examples from the [stickynotes containers](../stickynotes-jb) 

* [docker compose yaml file](docker-compose.yaml-stickynotes.md)
    * [Dockerfile used for one of the containers](Dockerfile-used-with-compose-stickynotes.md)
* [makefile used to build this app](Makefile-stickynotes.md) 
## simple howtos
* [how to add your image to docker hub](PUSHTODOCKERHUB.com]
* how to create a non-web app container
* how to create a web app container
* how to create a web app + database container(s)
