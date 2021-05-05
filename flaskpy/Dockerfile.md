## Dockerfile with explanations 
```
FROM python:3-alpine
LABEL maintainer="P.M.Campbell" email="pcampbell.edu@gmail.com"
```
* FROM:  the image to be pulled from the docker hub, you choose a base image that has most of what you want or your start with a basic image (alpine, ubuntu etc.)
* MAINTAINER: labeling information (deprecated)
* LABEL: labeling information in <key>=<value> pairs
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
