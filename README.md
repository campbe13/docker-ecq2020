# Containers, for teaching
Some containers & documentation I am working with  for teaching
my dockerfiles & scripts & instructions here, proofs of concept and basis for lectures / labs 

The following are in order of least to more complex

## general todo
* todo setup/use something like docker beginner labs https://github.com/docker/labs/tree/master/beginner/
from https://github.com/docker/labs  
* todo  checkout docker play for teaching https://labs.play-with-docker.com/  signin with docker id/pwd
* [Individual todos in the repo](TODOREADME.md) generated through [findtodo.sh](findtodo.sh)

## general docker platform (client, config etc)

* See [overview of docker commands, Dockerfile, compose etc](docker-usage-overview)
* Amongst others, see  [docker command reference](docker-usage-overview/DOCKERCMDS.md) for some notes on using docker commands
* See [docker-compose command reference](docker-usage-overview/DOCKERCOMPOSECMDS.md)  for some notes on using docker-compose commands


## [whalesay](whalesay)
working, in my hub.docker.com registry

* uses docker/whalesay imageeo 
* simple poc
* I added  some commands (figlet), runs to stdout 
* tested on / runs on 
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Windows 10 @ work (run from docker hub)
    * Azure registry used Dockerfile to add to Azure Container Registry (ACR) and run

## [javasample](simple-java) 
working, in my hub.docker.com registry

* uses openjdk 11 Oracle image
* builds & copies a few java .class files and creates a menu
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
## [xeyes](xeyes) 
working, not in the registry

* uses alpine latest
* install xeyes
* simple poc using an X11 app (needed --net=host)
* tested on / runs on 
    * ubuntu 18.04 (created & run)
## own-fortune 
working, not in the registry

* uses alpine latest
* install fortune, figlet, writes to stdout 
* tested on / runs on 
    * ubuntu 18.04 (created & run)

## [flaskpy](flaskpy) 
working, in my hub.docker.com registry

* uses python image
* install flask
* hello world web page
* exposes port 5000 \(flask default\)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Windows 10 @ Dawson ( run from docker hub)

## [shakespeare-jm](shakespeare-jm)
working, in my hub.docker.com registry

* TODO shakespeare-jm deploy to Azure,  & document it 

* uses php apache image
* install redis
* install app: Jeff B & Michael Mi (jm) students in PHP  2019-fall, assignment 1 for PHP 
* run php app to train model, data in redis
* php web app, uses redis and apache
* exposes port 80 \(apache default\)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * heroku  (pull from docker hub, push to & run from heroku registry) 
* built and tested using scripts

## [shakespeare-ec](shakespeare-ec)
working, in my hub.docker.com registry

* uses python apache image
* install redis, 
* install app Eira G & Camillia E (ec) students in PHP  2019-fall assignment 1 for PHP 
* run php app to train model, data in redis
* php web app, uses redis and apache
* exposes port 80 \(apache default\)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Centos 7.x (korra, pulled from docker hub & run)
    * heroku  (pull from docker hub, push to & run from heroku registry) 
* built and tested using `make`

## [javascript-mf](js-mf)
working, in my hub.docker.com registry

* uses alpine base image
* install lighttpd
* install app javascript & static html samples for lectures in js course
* simple web pages, uses lighttpd
* exposes port 80 \(apache default\)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
* built and tested using `make`

## [hello-world-go-heroku](hello-world-go-heroku)
working 2020-02-27

* simple go website, deployed to heroku using heroku cli
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Heroku (released from heroku registry)

## [stickynotes-jb](stickynotes-jb)
working, only the php image is in in my hub.docker.com registry, the others are base images + config
 
* TODO stickynotes-jb port to cloud & upload image to registry, test on fedora, Azure ??
* TODO tickynotes-jb  deploy to heroku, see [shakespeare-jm](shakespeare-jm) & document better

* port sticky notes app from PHP 2019, thanks to Jeff Boisvert, into a container
* containers using docker-compose & yaml
* a bit more complex than previous apps
    * current iteration uses internal network (name of service is hostname, pingable & used in config.ini for app
    * uses persistent storage for database 
* containers
    * apache + php app 
    * mysql   (no dockerfile, image from hub & config info in yaml)
    * phpmyadmin  (no dockerfile, image from hub & config info in yaml)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Centos 7.x (korra, pulled repo & used docker-compose to build & run)

## [from docker quick start nodejs bulletinboard](docker-nodejs-bulletinboard)
work in progress 2020-02-20

Original instructions here https://docs.docker.com/get-started/part2/

* uses x, y z 
* install x, y z
* install app https://github.com/dockersamples/node-bulletin-board/tree/master/bulletin-board-app

## [firefox](firefox)
work in progress 2020-02-06

* poc one app 
* isolate firefox in a container so that things like facebook can't get as much info ?? 
* problems with X11 -> can be done but containers are not meant to do this, really...
