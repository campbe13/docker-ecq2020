#  postgres base

I am struggling with installing postgres on python/alpine, before going to a base postgres image I am testing installing postgress via the postgress core image  https://hub.docker.com/_/postgres

* Uses postgres as a base image https://hub.docker.com/_/postgres


See the supporting [Dockerfile](Dockerfile) and the  [Makefile](Makefile)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

todo fix below, not updated


## TL;DR
### To run this app
1. install docker https://docs.docker.com/install/ 
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. Not on the registry you have to create then run see [create & run the container image](#create-&-run-the-container-image)

## run time
## docker registry image repo
not pushed to registry
## create & run the container image
You will first have to clone this repo and cd into this directory, the build assumes the Dockerfile is in the current working directory. check the [Makefile](Makefile) for version info etc.
1. clone the repo
2. cd into this directory
1. `make build`
2. `make run`
### docker commands
see  [common docker commands](../../docker-usage-overview/DOCKERCMDS.md) 
### docker-compose commands
see  [common docker commands](../../docker-usage-overview/DOCKERCOMPOSECMDS.md)


