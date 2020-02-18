# Containers, for teaching
working on Docker / container images for teaching
my dockerfiles & scripts here


## [flaskpy](flaskpy) 
working, in my hub.docker.com registry

* uses python image
* install flask
* hello world web page
* exposes port 5000 \(flask default)

## [whalesay](whalesay)
working, in my hub.docker.com registry

* uses docker/whalesay image
* simple poc
*  i added  some apps, runs to stdout 

## [shakespeare-jm](shakespeare-jm)
working, in my hub.docker.com registry

* J Boisvert & Michael Mi students in PHP  2019-fall
* assignment 1 for PHP 
* php web app, uses redis and apache

## [shakespeare-ec](shakespeare-ec)
work in progress 2020-02-12

* Eira G & Camillia E (ec) students in PHP  2019-fall
* assignment 1 for PHP 
* php web app, uses redis and apache

## [firefox](firefox)
work in progress 2020-02-06

* poc one app 
* isolate firefox in a container so that things like facebook can't get as much info ?? 
* problems with X11 -> can be done but containers are not meant to do this, really...

## own-fortune 
not completed, may abandon


## jeff-php
work in progress 2020-02-06

* port sticky notes app from PHP 2019, thanks to Jeff Boisvert, into a container
* apache + php app + mysql
