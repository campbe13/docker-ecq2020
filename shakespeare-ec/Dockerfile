# dockerfile for apache + php + redis + php 2019 assignment1
# 2020-2-19

FROM php:7.2-apache
MAINTAINER P Campbell pcampbell.edu@gmail.com

# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive

# install redis-server 
RUN apt-get -y update &&  apt-get -y install git redis-server && apt-get clean 

WORKDIR /var/www/html/

# install app
COPY app.tgz .
RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git

# install composer &  predis
# squaks and says install ext-phpiredis but this is ok
RUN  curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis

# expose the website port
EXPOSE 80

# start  redis server & train the model   (systemctl not installed on this image )
RUN redis-server /etc/redis/redis.conf ; php loader.php 

# launch apache  (systemctl not installed on this image )
CMD redis-server /etc/redis/redis.conf ; php loader.php ; apachectl -D  FOREGROUND