# dockerfile for apache + php for  php 2019 assignment2
# 2020-2-23

FROM php:7.2-apache
MAINTAINER P Campbell pcampbell.edu@gmail.com

# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive

# install redis-server 
RUN apt-get -y update && apt-get clean 

WORKDIR /var/www/html/

# install app
COPY app.tgz .
RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git

# expose the website port
EXPOSE 80

# launch apache   (systemctl not installed on this image )
CMD apachectl -D  FOREGROUND
