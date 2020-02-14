# dockerfile for apache + php + redis + php 2019 assignment1
FROM php:7.2-apache
MAINTAINER P Campbell pcampbell.edu@gmail.com

# env var for apt-get otherwise I get the error
# debconf: unable to initialize frontend: Dialog
# debconf: (TERM is not set, so the dialog frontend is not usable.)
# debconf: falling back to frontend: Readline
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get -y update && apt-get clean

# don't need this
# todo check how firewall is set in base images??
#RUN ufw allow in "Apache Full"

# install app
# n.b. better to install git, then clone from a repo
# hmmm, can't do recursive copy ?
#COPY app/   /var/www/html/
COPY app.tgz /var/www/html/ 
RUN cd /var/www/html/ ; tar -xzf app.tgz ; rm app.tgz 

# needed by predis
RUN apt-get -y install zip unzip curl && apt-get clean
# for debugging
RUN apt-get -y install net-tools 

# install composer &  predis
# squaks and says install ext-predis
RUN cd /var/www/html/app ; curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis
# install redis
RUN apt-get -y install redis-server && apt-get clean 

# show container info 
RUN echo "container info: ";ps -ef ;uname -a ; cat /etc/*release ;  netstat -plan 

WORKDIR /var/www/html/app

# expose the website port
EXPOSE 80
# start  redis server & train the model & launch apache  (systemctl not installed on this image )
CMD redis-server /etc/redis/redis.conf ; php load_model.php ; apachectl -D  FOREGROUND
