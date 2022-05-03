# containerized htop 

It uses an alpine image + htop command

Before you try this you must [install docker](https://docs.docker.com/install/)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

## TL;DR
The `--pid=host` options means the container uses the namespace of the host
v cool check it out!!!
* build: `$ docker build -t myhtop .`
* run:   `$ docker run -it -rm --pid=host myhtop

## Dockerfile
```bash
FROM alpine:latest
LABEL author="PMCampbell" created="2022-05-03"
LABEL description="trying htop in a container"
run apk add --update htop && rm -rf /var/cache/apk
CMD htop
```bash
