# dockerfile for apache + php + redis + php 2019 assignment1
FROM ubuntu
MAINTAINER P Campbell pcampbell.edu@gmail.com

RUN apt-get -y update 

# install apache2 & allow through firewall
RUN apt-get -y install apache2
# don't need this
# todo check how firewall is set in base images??
#RUN ufw allow in "Apache Full"

# install app
COPY app/   /var/www/html/

# install php & php cli
RUN apt-get -y install php libapache2-mod-php php-mysql php-cli

# install composer &  redis
RUN curl -sS https://getcomposer.org/installer|php
RUN ./composer.phar require predis/predis
# team3 EC  
RUN ln -s  /var/www/html/project1_team3 /var/www/html/app
RUN cd /var/www/html/app; php loader.php 
# team6 JM
#RUN ln -s  /var/www/html/Project1team06 /var/www/html/app
#RUN cd /var/www/html/app; php load_model.php 
RUN uname -a ; echo /etc/*release

