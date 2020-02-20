# Containers, for teaching
Some containers & documentation I am working with  for teaching
my dockerfiles & scripts & instructions here, proofs of concept and basis for lectures / labs 

The following are in order of least to more complex
## [whalesay](whalesay)
working, in my hub.docker.com registry

* uses docker/whalesay image
* simple poc
* I added  some commands (figlet), runs to stdout 
* tested on 
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Windows 10 @ work (run from docker hub)
    * Azure registry used Dockerfile to add to Azure Container Registry (ACR) and run

## [flaskpy](flaskpy) 
working, in my hub.docker.com registry

* uses python image
* install flask
* hello world web page
* exposes port 5000 \(flask default\)
* tested on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)

## [shakespeare-jm](shakespeare-jm)
working, in my hub.docker.com registry

* uses python apache image
* install redis
* install app: J Boisvert & Michael Mi students in PHP  2019-fall, assignment 1 for PHP 
* run php app to train model in redis
* php web app, uses redis and apache
* exposes port 80 \(apache default\)
* tested on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)

## [shakespeare-ec](shakespeare-ec)
work in progress 2020-02-12

* uses python apache image
* install redis
* install app Eira G & Camillia E (ec) students in PHP  2019-fall assignment 1 for PHP 
* run php app to train model in redis
* php web app, uses redis and apache
* exposes port 80 \(apache default\)
* tested on

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
