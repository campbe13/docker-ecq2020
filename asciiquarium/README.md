# asciiquiarium on alpin

This is a simple example of a single container app.  It uses an alpine image + asciiquarium.Flask to set up a web app.   

## install docker
If you plan to run this image locally install docker (it may also be run from any of the major cloud providers such as AWS, Azure, Google Cloud and some others such as heroku and openshift.

[Install](https://docs.docker.com/install/)  

__Note:__ note: If you have newly install docker, on \*nix, in order to run docker as a regular user you must add your userid to the docker group (then restart the shell) `sudo usermod -aG docker youruserid`  To check this you should see it as your group when you run `id`

__Note:__ If you are newly learning docker I suggest you use the command line interface as it may be used anywhere. 
### _Manually_ run asciiquarium
Since the following is applied to a running instance it will not be permanent, when you hit CTRL-C to end the container the state is not saved.
1. Download alpine image and launch the container, run a shell `docker run -it alpine /bin/ash`
1. You should now see the shell prompt `/#` install `apk add asciiquiarium`
1. if the install worked you can now run it  ` asciiquiarium`
### Create your own asciiquiarium image
If you want to create your own image to automatically run asciiquarium you can do so by building it.
This will use the same alpine image + a layer to install asciiquiarium + a command that will be launched at runtime for the container.
1. Create a Dockerfile, see below & you can copy this [Dockerfle](Dockerfile)
2. Use the Dockerfile to build your image, we will name it asciiq   `docker build -t asciiq .`  the default file is Dockerfile and the . (dot) says look in the cwd for it.
2. You will see the asciiq image with `docker images` if the build worked ok
2. You can now run your image `docker run -t asciiq`  the `-t` option with run says use a pseudo terminal.
#### Dockerfile 

	# image to download alpine:latest 
	FROM alpine

	# maintainer/creater info key=value pairs
	LABEL maintainer="P.M. Campbell"  email="pcampbell.edu@gmail.com" modified="2021-05"

	# run on the image, creates new layer
	RUN apk add asciiquarium

	# runtime
	CMD [ "asciiquarium" ] 

### Put your asciiquiarium image on docker hub, so you can run it from anywhere
tbd
### Extras
While the container is running you can shell into it if you wish, to see what is going on, if you run `docker ps` you will see the container name on the left: 
```
docker exec -it <containernamehere> /bin/ash
```
