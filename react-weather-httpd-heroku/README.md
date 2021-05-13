#  React Weather App 

This is a proof of concept containerized app to host a React javascript app that uses an api 
it is to be deployed to heroku
It uses an httpd image

Before you try this you must [install docker](https://docs.docker.com/install/)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

## TL;DR
### To build this container yourself  (general info)
1.  create a Dockerfile that uses an appropriate base image & installs the software you need.  See here for the [Dockerfile](Dockerfile) that was used to create this app.
    * Dockerfile reference https://docs.docker.com/engine/reference/builder/
3.  build the image, run `docker build -t **<containerimagename>** -f Dockerfile.local` (tweak Dockerfile until it works!)
4.  run the container, run `docker run -d -p 8888:80 <containerimagename>` 
    * `-d` detach the container app from the console, run the app in the background
    * `-p 8888:80` forward port 80 on the container to port 8888 on the current host
    * using port 8888 as an example, choose a high port (if you want non localhost access open the port on your firewall)
4. access the app http://localhost:8888/  (if you have opened the port you can use ip/hostname instead of localhost
#### Dockerfile for this app

      # Base image
      FROM httpd 
      # Adding key value pairs to label the image
      LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-05-05"
      # set current directory, this is the DocumentRoot for lighthttpd, where the content goes
      WORKDIR /var/www/localhost/htdocs/
      # copy my app files (in app/) from the host  to the container
      COPY app/* ./
   
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

`docker run -d -p <hostport>:80 tricia/weatherapp` 

1. there is a script [run.sh](run.sh) that you can use or  `docker run -d -p <hostport>:80 tricia/weatherapp` 
    * 80 is the container port and _hostport_ is the host that is running docker, port forwarding from container 80 to host _hostport_ is done by docker, choose a high port 
    * `-d` detaches the container, if you omit you will see  whatever the container logs
3. load a browser to access the app `http://localhost:<hostport>` 
4. if you want to access the app from another host, you must open your firewall for port _hostport_  then you can access it via or `http://ip.address.of.host:<hostport>` or `http://domain.name.of.host:<hostport>`

### To deploy to  heroku (5 free apps)
1. sign up for an account on [heroku](https://heroku.com) if you have not already done so
2. install  the [heroku cli](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)
3. login with your heroku credentials `heroku login -i`
4. Due to the way heroku sets up apps you must use  the PORT env var in the Listen directive `Listen ${PORT}`  
this can be done by copying [my-httpd.conf](my-httpd.conf) onto your image, so the last line of the Dockerfile must be
	`COPY my-httpd.conf /usr/local/apache2/conf/httpd.conf`
5. show the app `heroku apps` and `heroku apps:info -a <your app name>`
5. enable the app `heroku labs:enable --app <your app name> runtime-new-layer-extract`
5. you may need to authenticate to the heroku registry  `heroku container:login`
5. push to  the heroku registry, it will use your dockerfile to build the app image again
	`heroku container:push web --app <your app name>`
5. release the app 
	`heroku container:release web --app <your app name>`
5. test the app  `https://<your app name>.herokuapp.com`

_Note_ even though you are running the app on an internal port defined by the heroku container engine it is port forwarded to 443 externally and uses the *.herokuapp.com cert so traffic is encrypted.  


