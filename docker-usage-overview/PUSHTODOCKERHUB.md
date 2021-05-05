# Make your image available on Docker Hub 

Docker hub is a repsitory for container images, the free tier has unlimited public images and two private images as at 2021-05

If you want to run your own images or share your images from multiple hosts, without rebuilding you make them available here.

Docker hub is to container images what github/gitlab are to code bases 

Before you try this you must [install docker](https://docs.docker.com/install/)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.
This assumes you have built and tested your image previously,  you can try the [react app](../react-weather-app) or [asciiquarium](../asciiquarium) if you don't have one of your own to play with.

1. sign up for an account if you do not have one on [docker hub](https://hub.docker.com) 
2. sign in on [docker hub](https://hub.docker.com) 
 and create a repository it will have the format `<your username>/<choose an image name>` 
3. if you are on *nix use `docker login` with your credentials from the website, note this only needs to be done once as it will set up a file `~/.docker/config.json`  for reuse
3. build your container app with the tag for your repository `docker build -t <your username>/<image name>`
4. push the image to docker hub `docker push <your username>/<image name>`
5. test it on another computer  `docker run -d -p 8888:80 <your username>/<image name>`

For example if I am user sybil I create a repo bestapp via docker hub website, I've already run `docker login` before on this computer:
1.  `docker build -t sybil/bestapp`
2.  `docker push sybil/bestapp`

Run it from another computer  
* web app `docker run -d -p 8888:80 sybil/bestapp`
* stand alone app with tty output  `docker run -t sybil/bestapp`
* stand alone app with tty output and user input `docker run -it sybil/bestapp`
