# dockerfile for apache + php + redis + php 2019 assignment1
#
# HEROKU VERSION, see below
FROM php:7.2-apache
LABEL maintainer="P.M.Campbell" email="pcampbell.edu@gmail.com"

# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive


#  zip unzip curl needed by predis
RUN apt-get -y update && apt-get -y install zip unzip curl && apt-get clean

# install redis
RUN apt-get -y install redis-server && apt-get clean 

# install app
# n.b. better to install git, then clone app from a repo
COPY app.tgz /var/www/html/ 
RUN cd /var/www/html/ ; tar -xzf app.tgz ; rm app.tgz ; mv app/index.html .  

# install composer &  predis
# squaks and says install ext-predis, but this is ok
RUN cd /var/www/html/app ; curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis

WORKDIR /var/www/html/app

# expose the website port
EXPOSE 80

# start  redis server & train the model  (systemctl not installed on this image )
RUN redis-server /etc/redis/redis.conf ; php load_model.php 3 6 10 

# heroku workaround for issues to do with heroku (EXPOSE and another 
COPY herokufix.sh . 

# start  redis server &  launch apache   (systemctl not installed on this image )
# heroku workaround for heroku 
CMD  redis-server /etc/redis/redis.conf ; chmod +x herokufix.sh ; ./herokufix.sh ; apachectl -D FOREGROUND 
# run from docker
#CMD  redis-server /etc/redis/redis.conf ;  apachectl -D  FOREGROUND
