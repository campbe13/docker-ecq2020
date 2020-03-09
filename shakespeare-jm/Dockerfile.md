# Dockerfile with explanations
```
# dockerfile for apache + php + redis + php 2019 assignment1
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
RUN apt-get -y update && apt-get clean

# needed by predis
RUN apt-get -y install zip unzip curl && apt-get clean

# install redis
RUN apt-get -y install redis-server && apt-get clean 
```  
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
```
# install app
# n.b. better to install git, then clone app from a repo
COPY app.tgz /var/www/html/ 
RUN cd /var/www/html/ ; tar -xzf app.tgz ; rm app.tgz ; mv app/index.html .  
``` 
* COPY copy from the local host to the container (AFAICT not possible to do a recursive copy) -- as this is a simple example we copy one file, a project would be installed through pulling from a git repo
```
# install composer &  predis
# squaks and says install ext-predis, but this is ok
RUN cd /var/www/html/app ; curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis
```  
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image, note we are chaining commands as we do at the bash shell
```
# working dir
WORKDIR /var/www/html/app
```
* WORKDIR this is effectiveley a cd on the container filesystem
```
# expose the website port
EXPOSE 80
```
* EXPOSE: by default ports are internal to docker networks only, unless they are explicitly exposed to the host, EXPOSE means that we can access this port from the host for the docker engine
```
# start  redis server & train the model & launch apache  (systemctl not installed on this image )
CMD redis-server /etc/redis/redis.conf ; php load_model.php 3 6 10 ; apachectl -D  FOREGROUND
```
* CMD: command to be run when the container is run

