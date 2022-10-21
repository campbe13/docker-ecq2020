# Express & NodeJs 

 
Proof of concpept dockerize an express api server & eventually deploy to heroku

Ref:  [nodejs + docker](https://nodejs.org/en/docs/guides/nodejs-docker-webapp/)
plus other container info in [my proj on containers](https://github.com/campbe13/docker-ecq2020)

Prev lab instrs 440

* week 13 [some beginner exercises incl install & deploy to docker hub](https://drive.google.com/drive/folders/1LQBipwLz1l_B6BN7obc5AT7kA3qdzPME?usp=sharing)
*  week 14 [http container, own JS app deploy to docker hub &  heroku](https://docs.google.com/document/d/1nnvo27ARdbKdYlOtsRgtiKOFEn74LuO5OikVjJ7gh5E/edit?usp=sharing)

below needs to be updated
Before you try this you must [install docker](https://docs.docker.com/install/)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

### TL;DR
Just run this app  (from docker hub)  `docker run campbe13/muppets -d -p 8888:3099`  where `8888` is your localhost port, access it via http://localhost:8888/

Or diy build  & run
1.  make changes to the app if you want (optional)
1.  BUILD  `docker build -t mupps . `
2.  RUN  `docker run  -d -p <hostport>:3099  mupps `
3.  test http://localhost:8888/, results should be muppets JSON ![image](https://user-images.githubusercontent.com/1751207/197226249-fd0dd0e9-d964-403e-9b6e-afc4fc16c22b.png)
3.  (optional) add to docker hub 

### To build this container  (general info)
First have a look at  the [Dockerfile](Dockerfile)  which contains the instructions to build the docker image. 

1.  build the image, run `docker build -t <containerimagename>` (tweak Dockerfile until it works!)
 
4.  run the container, run `docker run -d -p 8888:3099 <containerimagename>` 
    * `-d` detach the container app from the console, run the app in the background
    * `-p 8888:3099` forward port 3099 on the container to port 8888 on the current host
    * using port 8888 as an example, choose a high port (if you want non localhost access open the port on your firewall)

4. access the app http://localhost:8888/  (if you have opened the port you can use ip/hostname instead of localhost
### To make this app available on docker hub
1. sign up for an account if you do not have one on [docker hub](https://hub.docker.com) 
2. sign in on [docker hub](https://hub.docker.com) 
 and create a repository it will have the format `<your username>/<choose an image name>` 
  for example sybil/bestapp
3. if you are on *nix use `docker login` with your credentials from the website, it will set up a file `~/.docker/config.json`
3. build your container app with the tag for your repository `docker build -t <your username>/<image name>` for example `docker build -t sybil/bestapp`
   * note if you named it bestapp but need your userid you can use `docker tag bestapp sybil/bestapp` to rename it
4. push the image to docker hub `docker push <your username>/<image name>` for example `docker push sybil/bestapp`
5. test it on another computer  `docker run -d -p 8888:3099 <your username>/<image name>` for example i`docker run -d -p 8888:3099 sybil/bestapp`
#### debugging
If something is not working you can

* `docker images`  show all images
* `docker ps`   show all running containers
* `docker logs <container id>`   show the logs for your container find the id through ps

### To run this app from the docker hub image
It is available as a public image in my [docker hub account](https://hub.docker.com/repository/docker/campbe13/muppets)

2. run `docker run -d -p <hostport>:3099 tricia/muppets` 
    * 3099 is the container port and _hostport_ is the host that is running docker, port forwarding from container 3099 to host _hostport_ is done by docker, choose a high port 
    * `-d` detaches the container, if you omit you will see  whatever the container logs
3. load a browser to access the app `localhost:_hostport_` or `ip.address.of.host:_hostport_`
4. if you want to access the app from another host, you must open your firewall for port _hostport_

## docker registry image repo

### running on cloud (heroku other?? ) -- will update soon
tbd
