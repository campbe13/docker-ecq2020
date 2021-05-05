#  React Weather App 
This is a proof of concept containerized app to host a React javascript app that uses an api

It uses an alpine image + lighttpd

Before you try this you must [install docker](https://docs.docker.com/install/)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

## TL;DR
### To build this container  (general info)
2.  create a Dockerfile that uses an appropriate base image & installs the software you need.  See here for the [Dockerfile](Dockerfile) that was used to create this app.
    * Dockerfile reference https://docs.docker.com/engine/reference/builder/
3.  build the image, run `docker build -t **<containerimagename>** .` (tweak Dockerfile until it works!)
4.  run the container, run `docker run -d -p 8888:80 <containerimagename>` 
    * `-d` detach the container app from the console, run the app in the background
    * `-p 8888:80` forward port 80 on the container to port 8888 on the current host
    * using port 8888 as an example, choose a high port (if you want non localhost access open the port on your firewall)
4. access the app http://localhost:8888/  (if you have opened the port you can use ip/hostname instead of localhost
### To make this app available on docker hub
1. sign up for an account if you do not have one on [docker hub](https://hub.docker.com) 
2. sign in on [docker hub](https://hub.docker.com) 
 and create a repository it will have the format `<your username>/<choose an image name>` 
  for example sybil/bestapp
3. if you are on *nix use `docker login` with your credentials from the website, it will set up a file `~/.docker/config.json`
3. build your container app with the tag for your repository `docker build -t <your username>/<image name>` for example `docker build -t sybil/bestapp`
4. push the image to docker hub `docker push <your username>/<image name>` for example `docker push sybil/bestapp`
5. test it on another computer  `docker run -d -p 8888:80 <your username>/<image name>` for example i`docker run -d -p 8888:80 sybil/bestapp`

### To run this app from the docker hub image
It is available as a public image in my [docker hub account](https://hub.docker.com/repository/docker/tricia/weatherapp)

2. run `docker run -d -p <hostport>:80 tricia/weatherapp` 
    * 80 is the container port and _hostport_ is the host that is running docker, port forwarding from container 80 to host _hostport_ is done by docker, choose a high port 
    * `d` detaches the container, if you omit you will see  whatever the container logs
3. load a browser to access the app `localhost:_hostport_` or `ip.address.of.host:_hostport_`
4. if you want to access the app from another host, you must open your firewall for port _hostport_

## docker registry image repo

### running on cloud -- will update soon
You may be able to pull from docker hub with Azure, still to be tested others not sure, each cloud provider has it's own registry if you want to use any of those you will have to set up an account & use the Dockerfile & app to create your own image in the cloud's own registry. 
