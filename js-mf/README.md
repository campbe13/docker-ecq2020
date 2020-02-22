#  javascript-mf
This is a proof of concept containerized app to host javascript sample pages (no node.)
The code was written by M. Frydrychowiz to accompany lectures @ Dawson College for the Computer Science Javascript course in the 2rd year Winter 2018.  

My thanks to M. Frydrychowiz for lending their work

Note there was an attempt to create a minimal image and these are static javascript pages exposed through a directory structure installed in the container. 

It uses an alpine image + lighttpd
## TL;DR
### To run this app
1. install docker https://docs.docker.com/install/ 
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. run `docker run -d -p 8888:80 tricia/js-mf` 
    * 80 is the container port and 8888 is the host that is running docker, port forwarding from
 container 80 to host 8888 is done by docker, choose a high port if you don't want 8888
    * \-d detaches the container, if you omit you will see the startup and the apache output
3. load a browser to access the app `localhost:8888` or `ip.address.of.host:8888`
### To build a container  (general info)
1.  install docker https://docs.docker.com/install/
2.  create a Dockerfile that uses an appropriate base image & installs the software you need.  See here for the [Dockerfile](Dockerfile.md) with explanations that was used to create this app.
    * Dockerfile reference https://docs.docker.com/engine/reference/builder/
3.  build the image, run `docker build -t **containerimagename** .` (tweak Dockerfile until it works!)
4.  run the container, run `docker run containerimagename`       to test it.
**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

**__NOTE:  TL;DR is complete, everything that follows is still being edited, do not rely on it.__**
## docker registry image repo
It is available as a public image in my repo 
https://hub.docker.com/repository/docker/tricia/js-mf

### running an image
If you don't want to clone this repo to use my Makefile you can run this image (provided docker is installed) use this command change hostport to whatever you want (high is eaiser wrt firewalls) docker will do port forwarding for you:
```
docker run -p hostport:80 tricia/js-mf
```
### running on cloud -- will update soon
You may be able to pull from docker hub with Azure, still to be tested others not sure, each cloud provider has it's own registry if you want to use any of those you will have to set up an account & use the Dockerfile & app to create your own image in the cloud's own registry. 
## Makefile 
This image was built with a [Makefile](Makefile), see here for [Makefile with explanations](Makefile.md)

## Creating a container image (Dockerfile)
Multi container apps use docker compose yaml and Dockerfiles, this app has a single container so everything to define the image is in the Dockerfile.  You need the Dockerfile to create the image, so that you can add it to a repository & reuse the container.  Once it is in the repo you no longer need the Dockerfile, unless you are going to make changes to the app or its supporting software or config. 

See here for the [Dockerfile](Dockerfile.md) with explanations that was used to create this app.
