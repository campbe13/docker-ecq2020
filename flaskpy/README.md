# flaskpoc

This is a proof of concept single container app.  It uses a python alpine image + Flask to set up a web app.   

## docker registry image repo

It is available as a public image in my repo https://hub.docker.com/repository/docker/tricia/flaskpoc

If you don't want to clone this repo you can run this image (provided docker is installed):
```
docker run -p hostport:5000 tricia/flaskpoc
```
note: If you have newly install docker in order to run docker as a regular user you must add your userid to the docker group (then restart the shell) `sudo usermod -aG docker youruserid`  To check this you should see it as your group when you run `id`


## Scripts (install docker before using)
### run.from.hub.sh
This script will pull the public image and run it. 
### build.run.sh
This script will build the image from the Dockerfile in this repo, then run it.

## Dockerfile with explanations 
```
FROM python:3-alpine
MAINTAINER P.M.Campbell pcampbell.edu@gmail.com

RUN pip install --no-cache-dir Flask

COPY hello.py /usr/local/bin/hello.py 

# default flask port
EXPOSE 5000

# working dir
WORKDIR /usr/local/bin

# runtime
CMD [ "python", "./hello.py" ] 
```
* FROM:  the image to be pulled from the docker hub
* MAINTAINER: 
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
* COPY copy from the local host to the container (AFAICT not possible to do a recursive copy
 * as this is a simple example we copy one file, a project would be installed through pulling from a git repo
* EXPOSE:  ports are internal to docker networks only, unless they are explicitly exposed to the host
* WORKDIR: this is effectively a cd on the container filesystem
* CMD: command to be run when the container is runs
