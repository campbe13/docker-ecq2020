# Docker 
The docker platform consists of three main components, the docker command, dockerd or containerd the container engine, and Repositorys.  On top of docker commands there is a separate command `docker-compose` and default config file `docker-compose.yaml` or `docker-compose.yml`.   There is some cross over & interaction between the two.  This doc is mostly about docker-compose  commands that I have used / are widely used.
NOTE: INCOMPLETE TODO add docker-compose commands
![docker engine](https://docs.docker.com/engine/images/engine-components-flow.png)
## Todo
* Future ??? set up a cheat sheet for student something like https://github.com/wsargent/docker-cheat-sheet ??
* Add screenshots & text examples from the READMEs in other repos.
## References
A **Dockerfile** is a clear text file that contains commands that `docker build` would use to assemble a container image.
**docker compose yaml** is a clear text file that is used to build multiple containers. Docker compose sits ontop of Dockerfiles we use compose for multi container apps.
* [docker compose syntax](https://docs.docker.com/compose/compose-file/)
* [Dockerfile syntax](https://docs.docker.com/engine/reference/builder/)
    * [Dockerfile best practices](https://docs.docker.com/develop/develop-images/dockerfile_best-practices/)
### Install
* Docker https://docs.docker.com/install/ 
* docker-compose  https://docs.docker.com/compose/install/
## running docker
These are standard systemd server controll commands.
* enable on startup `systemctl enable docker`
* stop running dockerd `systemctl stop docker`
* start dockerd `systemctl start docker`
* show status `systemctl status docker`
```
tricia@acerubuntu1804:~$ systemctl status docker
● docker.service - Docker Application Container Engine
   Loaded: loaded (/lib/systemd/system/docker.service; enabled; vendor preset: enabled)
   Active: active (running) since Thu 2020-02-13 12:41:00 EST; 1 weeks 5 days ago
     Docs: https://docs.docker.com
 Main PID: 1056 (dockerd)
    Tasks: 28
   CGroup: /system.slice/docker.service
           ├─ 1056 /usr/bin/dockerd -H fd:// --containerd=/run/containerd/containerd.sock
           ├─ 6193 /usr/bin/docker-proxy -proto tcp -host-ip 0.0.0.0 -host-port 8900 -container-ip 172.
           └─19364 /usr/bin/docker-proxy -proto tcp -host-ip 0.0.0.0 -host-port 8080 -container-ip 172.

Feb 25 17:20:10 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:20:10.969971949-05:00" level=info msg
Feb 25 17:20:11 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:20:11.366493217-05:00" level=info msg
Feb 25 17:22:33 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:22:33.087509650-05:00" level=info msg
Feb 25 17:22:45 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:22:45.081198463-05:00" level=error ms
Feb 25 17:23:49 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:23:49.792125563-05:00" level=info msg
Feb 25 17:24:09 acerubuntu1804 dockerd[1056]: time="2020-02-25T17:24:09.040587917-05:00" level=info msg
```
## Containers & Images 
Building and running :
```
Dockerfile ------> `docker build` ----> image ---> `docker run` ---> running app!
```
```
docker-compose.yaml && Dockerfile(s) ------> `docker-compose build` ----> images ---> `docker-compose run` ---> running app!
```
Running from local dockerd:

once the image is working you can run it over & over
```
image ---> `docker run` ---> running app!
```
```
images ---> `docker-compose run` ---> running app!
```
Publish it in a registry: 

once the image is working you can publish it in a registry (a bit like git, but not)
```
image ---> `docker-compose push ` ---> image in a repo! 
```
todo update for docker-compose

Running from a repository dockerd:

once the image is working you can run it over & over and from anywhere that has dockerd /docker installed
it will search the docker hub (in this case) to find the image
```
`docker run` ---> running app!
```
# docker-compose commands

Incomplete list, the ones I have used (pcampbell)

# docker-compose up todo  add more commands, incomplete
Will build if needed and bring up the images needed for the containers for this app.
When you run an image if it is on the local box it will be loaded from there if not the registriy will be searched.  If the image is found in the registry (but not locally) a `docker pull` is performed, then the container image is run.

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

n.b. for full info see `man docker ps`

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
# docker logs 
Show the log files from a running container
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/jeff-php-mysql$ docker logs shakespeare-jm
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.3. Set the 'ServerName' directive globally to suppress this message
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.3. Set the 'ServerName' directive globally to suppress this message
[Sat Feb 22 22:21:46.276748 2020] [mpm_prefork:notice] [pid 13] AH00163: Apache/2.4.38 (Debian) PHP/7.2.27 configured -- resuming normal operations
[Sat Feb 22 22:21:46.277134 2020] [core:notice] [pid 13] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
192.168.0.192 - - [22/Feb/2020:22:21:52 +0000] "GET / HTTP/1.1" 200 779 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
192.168.0.192 - - [22/Feb/2020:22:21:53 +0000] "GET /favicon.ico HTTP/1.1" 404 493 "http://192.168.0.117:8080/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/index.php HTTP/1.1" 200 890 "http://192.168.0.117:8080/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/styles/main_styling.css HTTP/1.1" 200 1521 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/images/shakespeare.png HTTP/1.1" 304 183 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/images/spotlight.png HTTP/1.1" 304 183 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"

```
# docker stop
Stop the running container 
To stop the container (The image is still there, you can start it again, it will not take as long as it does not have to download) run `docker stop containername`

n.b. for full info see `man docker stop`

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

n.b. for full info see `man docker images`

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
# docker information commands
## docker info
```
tricia@acerubuntu1804:~$ docker info
Client:
 Debug Mode: false

Server:
 Containers: 5
  Running: 2
  Paused: 0
  Stopped: 3
 Images: 58
 Server Version: 19.03.5
 Storage Driver: overlay2
  Backing Filesystem: extfs
  Supports d_type: true
  Native Overlay Diff: true
 Logging Driver: json-file
 Cgroup Driver: cgroupfs
 Plugins:
  Volume: local
  Network: bridge host ipvlan macvlan null overlay
  Log: awslogs fluentd gcplogs gelf journald json-file local logentries splunk syslog
 Swarm: inactive
 Runtimes: runc
 Default Runtime: runc
 Init Binary: docker-init
 containerd version: b34a5c8af56e510852c35414db4c1f4fa6172339
 runc version: 3e425f80a8c931f88e6d94a8c831b9d5aa481657
 init version: fec3683
 Security Options:
  apparmor
  seccomp
   Profile: default
 Kernel Version: 4.15.0-76-generic
 Operating System: Ubuntu 18.04.4 LTS
 OSType: linux
 Architecture: x86_64
 CPUs: 2
 Total Memory: 3.784GiB
 Name: acerubuntu1804
 ID: OCBQ:L5MG:YI4O:643Q:GUCS:H7G3:5AVO:2KCK:NYDG:UXCS:7G2O:3OCU
 Docker Root Dir: /var/lib/docker
 Debug Mode: false
 Username: tricia
 Registry: https://index.docker.io/v1/
 Labels:
 Experimental: false
 Insecure Registries:
  127.0.0.0/8
 Live Restore Enabled: false

WARNING: No swap limit support
```
## docker version
```
tricia@acerubuntu1804:~$ docker version
Client: Docker Engine - Community
 Version:           19.03.5
 API version:       1.40
 Go version:        go1.12.12
 Git commit:        633a0ea838
 Built:             Wed Nov 13 07:29:52 2019
 OS/Arch:           linux/amd64
 Experimental:      false

Server: Docker Engine - Community
 Engine:
  Version:          19.03.5
  API version:      1.40 (minimum version 1.12)
  Go version:       go1.12.12
  Git commit:       633a0ea838
  Built:            Wed Nov 13 07:28:22 2019
  OS/Arch:          linux/amd64
  Experimental:     false
 containerd:
  Version:          1.2.10
  GitCommit:        b34a5c8af56e510852c35414db4c1f4fa6172339
 runc:
  Version:          1.0.0-rc8+dev
  GitCommit:        3e425f80a8c931f88e6d94a8c831b9d5aa481657
 docker-init:
  Version:          0.18.0
  GitCommit:        fec3683
tricia@acerubuntu1804:~$
```
# docker admin commands
## docker system prune
Remove unused data: images, volumes

n.b. for full info see `man docker exec`
Use  `docker system prune` or to omit the prompt `docker system prune -f`


 1151  docker-compose config --services 
 1162  docker-compose config --services 
 1164  docker-compose --version
 1167  docker-compose config --services
 1168  docker-compose config 
 1171  docker-compose config 
 1174  docker-compose config -D
 1175  docker-compose -D config
 1176  docker-compose build 
 1211  docker-compose up 
 1214  docker-compose build
 1215  docker-compose up
 1242  docker-compose up
 1243  docker-compose -d up
 1244  docker-compose up -d
 1280  docker-compose stop 
 1281  docker images 
 1282  docker-compose 
 1283  docker ps
 1284  docker-compose 
 1285  docker images
 1286  docker system prune
 1287  docker-compose up -d 
 1288  ls 
 1289  docker ps 
 1290  docker logs
 1291  docker-compose logs 
 1335  docker system prune 
 1336  docker-compose up -d 
 1346  docker logs
 1347  docker-compose logs
 1348  cd -
 1349  docker-compose logs
 1350  gedit mysql/dbseed.sql 
 1351  docker-compose build db
 1352  docker-compose stop 
 1353  docker-compose build
 1354  docker-compose up -d
 1355  docker-compose stop 
 1356  ls 
 1357  docker-compose build
 1358  docker-compose up db
 1365  docker-compose stop
 1366  docker-compose  up -d 
 1367  docker-compose logs
 1368  docker-compose logs -f
 1378  cd ..
 1379  docker-compose 
 1380  docker-compose down 
 1381  docker-compose build
 1382  docker-compose up -d
 1397  cd -
 1398  docker-compose down
 1399  docker-compose build 
 1400  docker-compose up -d
 1401  ls
 1402  docker ps
 1403  docker logs
 1404  docker-compose logs
 1405  ls
 1440  bg
 1441  docker-compose down 
 1442  docker-compose build
 1443  docker-compose up -d
 1444  docker ps
 1455  docker ps
 1456  docker-compose up -d
 1457  docker ps
 1458  docker-compose logs 
 1459  vi mysql/dbsetup.sql 
 1460  docker-compose build db
 1461  docker-compose stop 
 1462  docker-compose up -d 
 1463  docker-compose logs
 1464  docker ps 
 1465  docker-compose stop 
 1785  ls 
 1786  docker-compose build 
 1787  cd ../../proj2php/jeffstickyphp/
 1788  cat database-utils/config.ini
 1789  grep server_name `find ./`
 1790  docker ps
 1791  docker-compose up 
 1792  cd -
 1793  docker-compose up 
 1794  docker ps
 1795  docker network 
 1796  docker images
 1797  docker system prune
 1798  docker-compose up 
 1803  sudo systemctl status mysql
 1804  docker-compose up 
 1814  systemctl status mysql
 1815  docker-compose up 
 1827  ls 
 1828  docker-compose up
 1829  ls 
 1830  ls dbsetup
 1831  mv dbsetup.sql dbsetup
 1832  docker-compose up -d 
 1833  docker-compose logs
 1834  docker-compose logs -f
 1835  gedit dbsetup/dbsetup.sql 
 1836  docker-compose down 
 1837  docker-compose logs -f
 1838  docker-compose up -d 
 1839  docker-compose logs -f
 1840  docker-compose down 
 1842  docker-compose logs -f
 1883  ls 
 1916  docker stop stickynotes-jb_db_1 
 1917  docker-compose up db -d 
 1918  cd ecq/docker-ecq2020/stickynotes-jb/
 1919  docker-compose up db -d 
 1920  docker-compose -d up db
 1921  docker-compose up db
 1922  docker-compose up -d 
 1923  docker exec -it stickynotes-jb_php_1 bash
 1924  docker-compose down 
 1925  docker-compose rm
 1926  docker-compose system prune
 1927  docker-compose images
 1928  docker-compose port
 1929  docker-compose up -d 
 1930  docker-compose  network 
 1931  docker-compose version 
 1932  docker-compose logs -f 
 1933  docker-compose logs -t
 1938  ls
 1939  grep mysqli *
 1940  grep mysqli */*
 1941  gedit php/Dockerfile 
 1942  docker-compose down
 1943  docker-compose up -d 
 1944  docker-compose logs -t
 1945  docker exec -it stickynotes-jb_php_1 bash
 1946  docker images
 1947  docker rmi stickynotes-jb_php:latest 
 1948  docker-compose stop
 1952  docker rmi stickynotes-jb_php:latest 
 1953  docker images
 1954  docker-compose up -d 
 1955  vi php/Dockerfile 
 1956  docker-compose up -d 
 1957  docker-compose logs -t 
 1958  docker-compose logs -f
 1959  docker-compose stop 
 1964  docker volume rm stickynotes-jb_persistent 
 1965  docker stop 
 1966  docker-compose
 1975  docker ps 
 1977  docker-compose up
 2009  cd -
 2010  docker-compose stop 
 2011  cd ../../docker-ecq2020/stickynotes-jb/
 2012  docker-compose stop 
 2013  docker ps 
 2019  sudo iptables -nL -t nat 
 2020  docker-compose up -d 
 2025  docker ps -a
 2026  docker-compose  logs
 2027  docker-compose  logs db_1
 2028  docker-compose  logs stickynote_db_1
 2029  docker-compose  logs 
 2030  docker-compose  logs |grep db_1
 2031  docker-compose  logs |grep db_1 >db.logs.txt
 2032  gedit db.logs.txt &
 2033  cat docker-compose.yaml 
 2034  gedit docker-compose.yaml &
 2035  docker-compose stop 
 2036  docker-compose up -d 
 2037  docker ps
 2038  docker logs 
 2039  docker-compose logs
 2040  docker-compose  logs |grep db_1 >db.logs.txt
 2041  gedit db.logs.txt 
 2042  docker-compose build db
 2043  docker-compose db up
 2044  docker-compose up db
 2045  docker-compose up db 
 2046  docker-compose up db  -d
 2047  docker-compose -d up db
 2048  docker-compose stop 
 2049  docker-compose up -d 
 2061  ls 
 2063  docker-compose stop 
 2063  docker-compose rm 
 2067  docker rm stickynotes-jb_db_1
 2071  docker volume rm stickynotes-jb_persistent 
 2072  docker-compose up -d 
 2076  docker-compose logs  -f
 2078  docker-compose db up
 2079  docker-compose up db
 2080  docker ps -a
 2081  docker rm stickynotes-jb_db_1 
 2082  docker-compose up db
 2083  docker-compose rm
 2084  docker-compose stop
 2085  docker-compose rm
 2086  docker volumes ls
 2087  docker volume ls
 2088  docker volume rm stickynotes-jb_persistent 
 2090  docker-compose up -d 
 2102  rm db.logs.txt 
 2105  docker-compose push 
 2107  docker-compose ps 
 2107  docker-compose ps -a
