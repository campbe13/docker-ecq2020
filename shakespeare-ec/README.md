#  shakespeare-ec
This is a proof of concept containerized PHP app.   The code was written by E Garret & C Elachqar as an
assignment given by J. Nilakantan @ Dawson College for the Computer Science PHP course in the 3rd year PHP course Fall 2019.  

My thanks to everyone for lending me their work.

Note in this app the model is trained via a RUN so that it becomes part of the container, it does not need to be re-run in a CMD every time the app is run.

It uses a PHP & apache image + redis data store  
## TL;DR
### To run this app
1. install docker https://docs.docker.com/install/ 
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. run `docker run -d -p 8888:80 tricia/shakespeare-ec` 
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

## docker registry image repo
It is available as a public image in my repo 
https://hub.docker.com/repository/docker/tricia/shakespeare-ec

### running an image
If you don't want to clone this repo to use my Makefile you can run this image (provided docker is installed) use this command change hostport to whatever you want (high is eaiser wrt firewalls) docker will do port forwarding for you:
```
docker run -p hostport:80 tricia/shakespeare-ec
```
In the following example the command was `docker run -d -p 8008:80 tricia/shakespeare-ec`
See [here](RUNTIME-NIX.md) for using docker on a Fedora 31 box,  download from the hub and run the first time, non-detached so you see the startup and apache output.
![browser shot](shakespeare-ec-container.PNG)

### running on cloud
You may be able to pull from docker hub with Azure, still to be tested others not sure, each cloud provider has it's own registry if you want to use any of those you will have to set up an account & use the Dockerfile & app to create your own image in the cloud's own registry.  I will add this information elsewhere.
## Makefile 
Instead of scripts this image was built with a [Makefile](Makefile), see here for [Makefile with explanations](Makefile.md)
## Creating a container image (Dockerfile)
Multi container apps use docker compose yaml and Dockerfiles, this app has a single container so everything to define the image is in the Dockerfile.  You need the Dockerfile to create the image, so that you can add it to a repository & reuse the container.  Once it is in the repo you no longer need the Dockerfile, unless you are going to make changes to the app or its supporting software or config. 

See here for the [Dockerfile](Dockerfile.md) with explanations that was used to create this app.
## docker commands
see  [common docker commands](DOCKERCMDS.md) 
