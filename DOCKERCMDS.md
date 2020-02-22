# Docker 
## Todo
* Future ??? set up a cheat sheet for student something like https://github.com/wsargent/docker-cheat-sheet ??
* Add screenshots & text examples from the READMEs in other repos.
## Containers & Images 
Building and running :
```
Dockerfile ------> `docker build` ----> image ---> `docker run` ---> running app!
```
Running from local dockerd:

once the image is working you can run it over & over
```
image ---> `docker run` ---> running app!
```
Publish it in a registry: 

once the image is working you can publish it in a registry (a bit like git, but not)
```
image ---> `docker image push ` ---> image in a repo! 
```
Running from a repository dockerd:

once the image is working you can run it over & over and from anywhere that has dockerd /docker installed
it will search the docker hub (in this case) to find the image
```
`docker run` ---> running app!
```
# Docker commands

Incomplete list, the ones I have used (pcampbell)

# docker run
Run an image, it becomes a container 

n.b. for full info see `man docker run`

Use the following to launch an image as a container & detach from the terminal
```
docker run -d -t  **containerimagename**
# show the logs at the terminal (no detach)
docker run -t  **containerimagename**
# give the container a name (random is generated if you omit)
docker run -d -t **containerimagename** -name **containername** 
```
Use the `-p hostport:containerport` option to port forward from the container to the host 
```
docker run -d -p 8888:80 -t **containerimagename** -name **containername** 
```
Use the following if you want to shell into a container but it only loads for seconds 
ex it is not running anything or the ENTRYPOINT or  CMD are failing somehow
```
docker run -it --entrypoint /bin/sh tricia/js-mf
```
Forward the container system log to the host system log example run shell
```
$ docker run -v /dev/log:/dev/log -it alpine /bin/sh	
# logger "test logging on the host, 1,2,3 testing"
# exit
```
exit & check the host log
```
$ journalctl -b |grep testing
```
`--read-only`

Use the following to have the container's root file system mounted read only.
The defaults to mount it read/write for testing purposes. 

In production it is best to run read only ! 
`--tmpfs`
mount a temporary file system into a container, can use options as used for Linux mount flags,
if none are used the sytem uses 
`rw,noexec,nosuid,nodev,size=65536k`
```
docker run --read-only --tmpfs /run --tmpfs /tmp -i -t fedora /bin/bash
```
# docker exec
Execute a command on the container.

n.b. for full info see `man docker exec`

Use the following to shell into a running container (must be runnign
`docker exec -it` *containername* ` sh` 
or 
`docker exec -it` *containername* ` bash` 
# docker build
build an image from a Dockerfile in the current working directory

n.b. for full info see `man docker build`

```
docker build -t *containerimagename* . 
```
# docker ps
show running container processes
# docker images
show images on the localhost
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/$ docker images
REPOSITORY              TAG                 IMAGE ID            CREATED             SIZE
tricia/js-mf            latest              b622afb24977        31 minutes ago      15.3MB
<none>                  <none>              6232b0b2f62a        About an hour ago   15.3MB
tricia/shakespeare-ec   latest              8524faf9b7b8        8 hours ago         602MB
tricia/bbnodejs         latest              d40c84e8b33d        31 hours ago        154MB
node                    current-slim        46ae64084208        2 days ago          140MB
tricia/shakespeare-jm   latest              becc74c4f566        4 days ago          479MB
tricia/flaskpoc         latest              77d6b8a97457        8 days ago          119MB
python                  3-alpine            a1cd5654cf3c        2 weeks ago         109MB
tricia/whalesay1        latest              0a7b27bff74b        2 weeks ago         276MB
jess/firefox            latest              34ac6ae5207a        2 weeks ago         796MB
php                     7.2-apache          4907b55fd512        2 weeks ago         410MB
alpine                  latest              e7d92cdc71fe        5 weeks ago         5.59MB
hello-world             latest              fce289e99eb9        13 months ago       1.84kB
```
