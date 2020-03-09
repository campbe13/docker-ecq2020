# Dockerfile with explanations
```
# dockerfile for apache + php for  php 2019 assignment2
# 2020-2-29	

FROM php:7.2-apache
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-xx-xx"
```
* \# comments, as with bash scripts
* FROM the base image to be pulled from docker hub,  you choose a base image that has most of what you want or your start with a basic image (python, apache, php  etc.)
* LABEL user defined meta data for the container image
```
# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive
```
* ENV environment variables, as in a bash shell, any needed 
```
# install updates
RUN apt-get -y update && apt-get clean 
# install mysql necessaries
RUN docker-php-ext-install mysqli pdo pdo_mysql
```
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image 
```
WORKDIR /var/www/html/

# install app
# note for test purposes it is being run from local disk, see yaml
#COPY app.tgz .
#RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git
``` 
* WORKDIR this is effectiveley a cd on the container filesystem
```
# expose the website port
EXPOSE 80
```
* EXPOSE: by default ports are internal to docker networks only, unless they are explicitly exposed to the host, EXPOSE means that we can access this port from the host for the docker engine
```
# launch apache   (systemctl not installed on this image )
CMD apachectl -D  FOREGROUND
```
* CMD: command to be run when the container is run
