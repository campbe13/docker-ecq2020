# asciiquarium on alpine image

This is a simple example of a single container app.  It uses an alpine image + asciiquarium.

## install docker
If you plan to run this image locally install docker (it may also be run from any of the major cloud providers such as AWS, Azure, Google Cloud and some others such as heroku and openshift.

[Install](https://docs.docker.com/install/)  

__Note:__ note: If you have newly install docker, on \*nix, in order to run docker as a regular user you must add your userid to the docker group (then restart the shell) `sudo usermod -aG docker youruserid`  To check this you should see it as your group when you run `id`

__Note:__ If you are newly learning docker I suggest you use the command line interface as it may be used anywhere. 
## run asciiquarium
You can see the demo of both of these [via youtube](https://youtu.be/kW8bdAMyLIA)
### _Manually_ run asciiquarium
Since the following is applied to a running instance it will not be permanent, when type exit ito end the container the state is not saved.
1. Download alpine image and launch the container, run a shell `docker run -it alpine /bin/ash`
1. You should now see the shell prompt `/#` install `apk add asciiquarium`
1. if the install worked you can now run it  ` asciiquarium`

While it is running CTRL-C will kill asciiquarium, not the container.  After CTRL-C  you will be back to the shell prompt `/#` you can now type `exit` to end the container.

### Create your own asciiquarium image
If you want to create your own image to automagically run asciiquarum you can do so by building a new image, based on alpine.
This will use the same alpine image + a layer to install asciiquiarum + a command that will be launched at runtime for the container.
1. Create a Dockerfile, see below & you can copy this [Dockerfle](Dockerfile)
2. Use the Dockerfile to build your image, we will name it _asciiq_   `docker build -t asciiq .`  the default file is Dockerfile and the . (dot) says look in the cwd for it.
2. You will see the asciiq image with `docker images` if the build worked ok
2. You can now run your image `docker run -t asciiq`  the `-t` option with run says use a pseudo terminal.
While it is running CTRL-C will kill the container. 

Until and unless you remove the image, every time you want it you now simply run it `docker run -t asciiq`
#### Dockerfile 

	# image to download alpine:latest 
	FROM alpine

	# maintainer/creater info key=value pairs
	LABEL maintainer="P.M. Campbell"  email="pcampbell.edu@gmail.com" modified="2021-05"

	# install the software, run on the image, creates new layer
	RUN apk add asciiquarium

	# runtime
	CMD [ "asciiquarium" ] 

### Run your asciiquarium container from anywhere:  
I put it on docker hub so anyone can run it `docker run -t tricia/aaq` 

Docker hub repo https://hub.docker.com/r/tricia/aaq 

### Put your image on docker hub
How to put an app on docker hub see [push to docker hub](../docker-usage-overview/PUSHTODOCKERHUB.md)  You can also watch this demonstrated in this [youtube video](https://www.youtube.com/watch?v=iwWyfMmQTYw)

### Extras
While the container is running you can shell into it if you wish, to see what is going on, if you run `docker ps` you will see the container name on the left: 
```
docker exec -it <containernamehere> /bin/ash
```
