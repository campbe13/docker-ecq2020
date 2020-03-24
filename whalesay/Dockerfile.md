# Dockerfile with explanations
```
# simple dockerfile
FROM docker/whalesay:latest
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-29"
```
* \# comments, as with bash scripts
* FROM is the base image that will be pulled from the registry (docker hub in this case)
* LABEL user defined meta data for the container image
```
ENV DEBIAN_FRONTEND=noninteractive
```
* ENV environment variables, as in a bash shell, any needed 
```
RUN apt-get -y update 
RUN apt-get -y install figlet && apt-get -y install fortune
```  
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
```
CMD /usr/games/fortune -a | cowsay ; figlet "I love docker" 
```
* CMD:  command to be run when the container is run, this format invokes a command shell to launch the command
