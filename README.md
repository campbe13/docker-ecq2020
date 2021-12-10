# Containers, for teaching
Some containers & documentation I am working with  for teaching
my dockerfiles & scripts & instructions here, proofs of concept and basis for lectures / labs 

I have written up some of the work in a blog: [cloudnativeish blog](https://cloudnativeish.wordpress.com/)

* todo  update docker tagging in earlier repos

## general info
### other repos & sites
* using Gitlab CI to deploy to gitlab pages
   * [Gitlab CI to pages lab exercise](https://docs.google.com/document/d/1-_-l-M8RhhsLC62ahop_tME6tIMv1lVqcgMQrnnlGMU/edit?usp=sharing) 
   * base repo https://gitlab.com/campbe13/demo1-gitlab-ci
   * The gitlab page https://campbe13.gitlab.io/demo1-gitlab-ci/
* using Travis CI to deploy to github pages 
   * base repo  https://github.com/campbe13/javascript-320 
   * The github page https://campbe13.github.io/javascript-320/
   * How To for setting up Travis -> github pages https://docs.google.com/document/d/1Yrijs0V0053suuavLWUzIvQsyPURtc33o6zOMsBAOrE/edit?usp=sharing
* A simple java springboot app using Jenkins CI on a Dawson Server http://korra.dawsoncollege.qc.ca:8080/
   * "engineering log" for setup of Jenkins https://docs.google.com/document/d/1stFH2Eq3EjCleLTMwAIYoXY0AYmG0QlgW1FxiY8FWoU/edit?usp=sharing
### general todo
* todo setup/use something like docker beginner labs https://github.com/docker/labs/tree/master/beginner/
from https://github.com/docker/labs  
* todo  checkout docker play for teaching https://labs.play-with-docker.com/  signin with docker id/pwd
* [Individual todos in the repo](TODOREADME.md) generated through [findtodo.sh](findtodo.sh)
### general docker platform (client, config etc)
* See [overview of docker commands, Dockerfile, compose etc](docker-usage-overview)
* Amongst others, see  [docker command reference](docker-usage-overview/DOCKERCMDS.md) for some notes on using docker commands
* See [docker-compose command reference](docker-usage-overview/DOCKERCOMPOSECMDS.md)  for some notes on using docker-compose commands

# containers 2021
Used in teaching & videos for 420-440, in no particular order 
## [asciiquarium](asciiquarium)
console app
* base image alpine
* install & launch asciiquarium
* youtube videos 
* tested on/runs on
    * ubuntu 20.04
    * Windows 10 pro
## [react-weather-app](react-weather-app)
web app
* base image alpine
* install lighthttpd
* copy index.html & react app
* web app needs port 80 forwarded
* tested on/runs on
    * ubuntu 20.04
    * Windows 10 pro
## [react weather app deploy-to-heroku](react-weather-httpd-heroku)
web app
* base image alpine
* install lighthttpd
* copy index.html & react app
* web app needs port 80 forwarded
* tested on/runs on
    * ubuntu 20.04
    * Windows 10 pro
    * heroku
## Not a container [lab exercises](container-lab-exercises) 
# containers 2020
The following are in order of least to more complex
## [whalesay](whalesay)
console app

working, in my hub.docker.com registry

* uses docker/whalesay image
* simple poc
* I added  some commands (figlet), runs to stdout 
* tested on / runs on 
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Windows 10 @ work (run from docker hub)
    * Azure registry used Dockerfile to add to Azure Container Registry (ACR) and run

## [javasample](simple-java) 
console app
working, in my hub.docker.com registry

* uses openjdk 11 Oracle image
* builds & copies a few java .class files and creates a menu
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
## [xeyes](xeyes) 
console app requires X11 forwarding if run remotely

working, not in docker hub

* uses alpine latest
* install xeyes
* X11 -> can be done but containers are not meant to do this, really... see the [Makefile](xeyes/Makefile)
* tested on / runs on 
    * ubuntu 18.04 (created & run)

__Note:__  Uses X11 so when running the image config needs the following, if you omit you will get `Error: Can't open display:`  

```bash
--net=host
-e DISPLAY=${DISPLAY}  # environment
-v ${XAUTH}:/root/.Xauthority # volume
```
## [firefox](firefox)
console app requires X11 forwarding if run remotely

working, not in docker hub

* poc X11 app see also xeyes
* todo add README.md for firefox
* isolate firefox in a container so that things like facebook can't get as much info ?? 
* X11 -> can be done but containers are not meant to do this, really... see the [Makefile](firefox/Makefile)
* tested on / runs on 
    * ubuntu 18.04 (created & run)

## [own-fortune](own-fortune)
console app

working, not in docker hub

* uses alpine latest
* install fortune, figlet, writes to stdout 
* tested on / runs on 
    * ubuntu 18.04 (created & run)

## [flaskpy](flaskpy) 
web app

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
web app

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
web app 

working, in my hub.docker.com registry

* uses python apache image
* install redis
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
web app 

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
web app 

working 2020-02-27

* simple go website, deployed to heroku using heroku cli
* tested on / runs on
* exposes port 8080
    * ubuntu 18.04 (created & run)
    * Heroku (released from heroku registry)

## [stickynotes-jb](stickynotes-jb)
web app

working, only the php image is in in my hub.docker.com registry, the others are base images + config
 
* TODO stickynotes-jb port to cloud & upload image to registry, test on fedora, Azure ??
* TODO stickynotes-jb  deploy to heroku, see [shakespeare-jm](shakespeare-jm) & document better

* port sticky notes app from PHP 2019, thanks to Jeff Boisvert, into a container
* containers using docker-compose & yaml
* a bit more complex than previous apps
    * current iteration uses internal network (name of service is hostname, pingable & used in config.ini for app
    * uses persistent storage for database 
* containers
    * apache + php app (exposes port 80)
    * mysql   (no dockerfile, image from hub & config info in yaml)  (port 3306 internal to container network)
    * phpmyadmin  (no dockerfile, image from hub & config info in yaml) (exposes port 80)
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Centos 7.x (korra, pulled repo & used docker-compose to build & run)
## [digital ocean node.js demo app](digocean-nodejs)
web app 

working, not deployed to hub.docker.com

* simple node.js app
* node:alpine base image
* exposes port 8111
* tested on / runs on
    * ubuntu 18.04 (created & run)

## [springboot-java](springboot-java)
web app 

working, not deployed to hub docker com

* simple springboot app, compiled using maven
* openjdk:alpine base image
* exposes port 8080 
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Windows 10 (run from docker hub)
## [pandocker](pandocker)
console app, requires config file

working, deployed to docker hub

* pandoc core image, based on alpine
* uses a volume shared with the container at run time 
* tested on / runs on
    * ubuntu 18.04 (created & run)
    * Fedora 31 (run from docker hub)
    * Windows 10 Pro 64 bit  (run from docker hub)
## [mysql](mysql-example)
service app

working, using base image pulled from docker hub 

* mysql base image
* uses env variables to configure the db & scripts to start up
    * ubuntu 18.04 (run from docker hub)
    * Fedora 31 (run from docker hub)
    * todo run mysql image on windows
## [postgres](postgres-example)
service app 

work in progress 
testing using postgres, was having problems installing it
* postgres 9.3 installed on ubuntu base (working)
* postgres base (work in progress)

## [chromium](chromium)
NOT working, not in docker hub

* poc X11 app see also xeyes
* todo add README.md for chromium
* isolate chromium in a container so that things like facebook can't get as much info ?? 
* X11 -> can be done but containers are not meant to do this, really... see the [Makefile](chromium/Makefile)
* tested on / runs on 
    * ubuntu 18.04 (created & run)

__Note:__  Uses X11 so when running the image config needs the following, if you omit you will get `Error: Can't open display:`  
```bash
--net=host
-e DISPLAY=${DISPLAY}  # environment
-v ${XAUTH}:/root/.Xauthority  # volume
```

## [django](django)
work in progress 2020-04-28

## [vue.js-tutorial](vue.js-tutorial)
work in progress 2020-04-16

## [nodeschool setup](learn.js.node.js)
work in progress 2020-04-16
Trying to use http://nodeschool.io/  course/workshops in containers.

## [shakespeare-ec on Azure](azure-deploy-shakespeare-ec)
work in progress 2020-04-16
porting  [shakespeare-ec](#shakespeare-ec) to azure registry & running on azure

