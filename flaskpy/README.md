# flaskpoc

This is a proof of concept single container app.  It uses a python alpine image + Flask to set up a web app.   

## docker registry image repo

It is available as a public image in my repo https://hub.docker.com/repository/docker/tricia/flaskpoc

If you don't want to clone this repo you can run this image (provided docker is installed) use this command change hostport to whatever you want (high is eaiser wrt firewalls):
```
docker run -p hostport:5000 tricia/flaskpoc
```
To access the app load a browser and use localhost or your ip address `localhost:hostport` or `your.ip.address:hostport`   
![browser shot](flaskcontainertest.PNG)

If you run the preceding command the container will have control of the shell and you will see error or debut messages.  In order to run the app in a headless manner you must `-d` detach:
```
docker run -d -p hostport:5000 tricia/flaskpoc
```
While the host is running you can shell into it if you wish, to see what is going on, if you run `docker ps` you will see the container name on the left: 
```
docker exec -it containernamehere sh
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
```
* FROM:  the image to be pulled from the docker hub, you choose a base image that has most of what you want or your start with a basic image (alpine, ubuntu etc.)
* MAINTAINER: labeling information
```
RUN pip install --no-cache-dir Flask
```
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
```
COPY hello.py /usr/local/bin/hello.py 
```
- COPY copy from the local host to the container (AFAICT not possible to do a recursive copy)
-- as this is a simple example we copy one file, a project would be installed through pulling from a git repo

```
# default flask port
EXPOSE 5000
```
* EXPOSE:  by default ports are internal to docker networks only, unless they are explicitly exposed to the host, EXPOSE means that we can access this port from the host for the docker engine 

```
# working dir
WORKDIR /usr/local/bin
```
* WORKDIR: this is effectively a cd on the container filesystem
```
# runtime
CMD [ "python", "./hello.py" ] 
```
* CMD: command to be run when the container is run
