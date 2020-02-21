# Dockerfile with explanations 
```
# dockerfile for apache + php + redis + php 2019 assignment1
# 2020-2-19
FROM php:7.2-apache
MAINTAINER P Campbell pcampbell.edu@gmail.com
```
* # comments, as with bash scripts
* FROM the base image to be pulled from docker hub, you choose a base image that has most of what you want or your start with a basic image (python, apache, php etc.)
* MAINTAINER: labeling information
```
# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive
```
* ENV environment variables, as in a bash shell, any needed
```
# install redis-server 
RUN apt-get -y update &&  apt-get -y install git redis-server && apt-get clean 
```
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
```
WORKDIR /var/www/html/
```
* WORKDIR effectively a `cd` on the container filesystem
```
# install app
COPY app.tgz .
RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git
```
* COPY copy from the local host to the container (AFAICT not possible to do a recursive copy) see the Makefile, the repo is pulled from git and tar'd into app.tgz 
* RUN: commands to be run on the image, this one has to be done after the app is coppied 
```
# install composer &  predis
# squaks and says install ext-phpiredis but this is ok
RUN  curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis
```
```
# expose the website port
EXPOSE 80
```
* EXPOSE: by default ports are internal to docker networks only, unless they are explicitly exposed to the host, EXPOSE means that we can access this port from the host for the docker engine
```
# start  redis server & train the model  (systemctl not installed on this image )
# train it here makes the image slightly bigger but reduces the
# startup time, from training in the CMD
RUN redis-server /etc/redis/redis.conf ; php loader.php 
```
Note:  the RUN layers are discrete anything started in  a RUN is not still running once it's finished
they are used to run commands 1 time on the container
so I have to start the redis-server again to be used by the web app

```
# start  redis server &  launch apache   (systemctl not installed on this image )
CMD  redis-server /etc/redis/redis.conf ; apachectl -D  FOREGROUND
```
CMD: command to be run when the container is run

