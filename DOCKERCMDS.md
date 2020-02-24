# Docker 
The docker platform consists of three main components, the [docker command](3, dockerd or containerd the container engine, and Repositorys.  This doc is mostly about [docker commands](# Docker commands) that I have used / are widely used.
![docker engine](https://docs.docker.com/engine/images/engine-components-flow.png)
## Todo
* Future ??? set up a cheat sheet for student something like https://github.com/wsargent/docker-cheat-sheet ??
* Add screenshots & text examples from the READMEs in other repos.
## References
A **Dockerfile** is a clear text file that contains commands that `docker build` would use to assemble a container image.
**docker compose yaml** is a clear text file that is used to build multiple containers. Docker compose sits ontop of Dockerfiles we use compose for multi container apps.
* (docker compose syntax)[https://docs.docker.com/compose/compose-file/]
* (Dockerfile syntax)[https://docs.docker.com/engine/reference/builder/]
    * (Dockerfile best practices)[https://docs.docker.com/develop/develop-images/dockerfile_best-practices/]
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
# docker build
build an image from a Dockerfile in the current working directory

n.b. for full info see `man docker build`

```
docker build -t *containerimagename* . 
```
# docker ps
show running container processes
if you want to see what is going on with the image use `docker ps` or `docker ps -a`
```
[tricia@acerfed31 ~]$ docker ps
CONTAINER ID        IMAGE                   COMMAND                  CREATED             STATUS              PORTS                  NAMES
9ad94ed4cb4b        tricia/shakespeare-jm   "docker-php-entrypoi…"   29 minutes ago      Up 29 minutes       0.0.0.0:8088->80/tcp   relaxed_shtern
[tricia@acerfed31 ~]$
```
In the above the container NAME is **relaxed_shtern** (you can name your containers when you run them if you do not docker names them.  
# docker exec
Execute a command on the container.

n.b. for full info see `man docker exec`

Use the following to shell into a running container (must be runnign
`docker exec -it` *containername* ` sh` 
or 
`docker exec -it` *containername* ` bash`
Using the running container from the docker ps section **relaxed_shtern** we could 
`docker exec -it relaxed_shtern sh`
Note, as you see below, when you shell into a container you are root, \#,  and the commands available will be limited, for example this image does not have netstat / ss / net-tools installed.  They could be installed but I would do that just for testing.
```
[tricia@acerfed31 ~]$ docker exec -ti relaxed_shtern sh
# ps aux
USER         PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
root           1  0.0  0.0   2384   764 ?        Ss   Feb17   0:00 /bin/sh -c redis-server /etc/redis/redis.conf ; php load_model.php 3 6 10 ; a
root           7  5.1  6.1 401984 352360 ?       Ssl  Feb17   1:42 redis-server 127.0.0.1:6379
root          16  0.0  0.0   2384   764 ?        S    Feb17   0:00 /bin/sh /usr/sbin/apachectl -D FOREGROUND
root          18  0.0  0.4  82900 25036 ?        S    Feb17   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data      19  0.0  0.2  83224 12208 ?        S    Feb17   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data      20  0.0  0.2  83224 12900 ?        S    Feb17   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data      21  0.0  0.1  82964  8272 ?        S    Feb17   0:00 /usr/sbin/apache2 -D FOREGROUND
# df -h
Filesystem                               Size  Used Avail Use% Mounted on
overlay                                   69G  9.2G   56G  15% /
tmpfs                                     64M     0   64M   0% /dev
tmpfs                                    2.8G     0  2.8G   0% /sys/fs/cgroup
shm                                       64M     0   64M   0% /dev/shm
/dev/mapper/fedora_localhost--live-root   69G  9.2G   56G  15% /etc/hosts
tmpfs                                    2.8G     0  2.8G   0% /proc/asound
tmpfs                                    2.8G     0  2.8G   0% /proc/acpi
tmpfs                                    2.8G     0  2.8G   0% /proc/scsi
tmpfs                                    2.8G     0  2.8G   0% /sys/firmware
# ls -l /var/www/html/app
total 1940
-rw-r--r--. 1 1000 1000     139 Feb 14 15:21 README.md
-rw-r--r--. 1 1000 1000      59 Feb 17 22:35 composer.json
-rw-r--r--. 1 1000 1000    2336 Feb 14 15:21 composer.lock
-rwxr-xr-x. 1 root root 1936645 Feb 17 22:35 composer.phar
drwxr-xr-x. 2 1000 1000    4096 Feb 14 15:21 data
drwxr-xr-x. 2 1000 1000    4096 Feb 14 15:21 images
-rw-r--r--. 1 1000 1000    5432 Feb 17 21:32 index.php
-rw-r--r--. 1 1000 1000    3097 Feb 17 21:12 load_model.php
drwxr-xr-x. 2 1000 1000    4096 Feb 14 15:21 model
drwxr-xr-x. 2 1000 1000    4096 Feb 14 15:21 styles
-rw-rw-r--. 1 1000 1000       0 Feb 14 21:27 today.2020-02-14
drwxr-xr-x. 4 root root    4096 Feb 17 22:35 vendor
# exit
```
# docker stop
Stop the running container 
To stop the container (The image is still there, you can start it again, it will not take as long as it does not have to download) run `docker stop containername`
```
[tricia@acerfed31 ~]$ docker ps
CONTAINER ID        IMAGE                   COMMAND                  CREATED             STATUS              PORTS                  NAMES
9ad94ed4cb4b        tricia/shakespeare-jm   "docker-php-entrypoi…"   39 minutes ago      Up 38 minutes       0.0.0.0:8088->80/tcp   relaxed_shtern
[tricia@acerfed31 ~]$ docker stop relaxed_shtern
relaxed_shtern
[tricia@acerfed31 ~]$ docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
[tricia@acerfed31 ~]$
```
# docker images
show images on the localhost

To see all images that are local, downloaded or created through Dockerfiles &/or compose yaml files use `docker images`.
I can run any of the below by name, they are downloaded so they run quickly.
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
