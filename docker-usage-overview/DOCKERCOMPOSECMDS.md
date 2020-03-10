# Docker 
The docker platform consists of three main components, the docker command, dockerd or containerd the container engine, and Repositorys.  On top of docker commands there is a separate command `docker-compose` and default config file `docker-compose.yaml` or `docker-compose.yml`.   There is some cross over & interaction between the two.  This doc is mostly about docker-compose  commands that I have used / are widely used.

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
docker-compose.yaml && Dockerfile(s) ------> `docker-compose build` ----> images ---> `docker-compose run` ---> running app!
```
Running from local dockerd:

once the image is working you can run it over & over
```
images ---> `docker-compose run` ---> running app!
```
```
images ---> `docker-compose up` ---> running app!
```
```
images ---> `docker-compose start` ---> running app!
```
Publish it in a registry: 

once the image is working you can publish it in a registry (a bit like git, but not)
```
images ---> `docker-compose push ` ---> images in a repo! 
```

# docker-compose commands

Incomplete list, the ones I have used (pcampbell)
* [up](#up)
* [build](#build)
* [images](#images)
* [stop](#stop)
* [logs](#logs)
* [exec](#exec)

## <a name="up">docker-compose up</a>
Will build if needed and bring up the images needed for the containers for this app.
When you run an image if it is on the local box it will be loaded from there if not the registriy will be searched.  If the image is found in the registry (but not locally) a `docker pull` is performed, then the container image is run.
 
Uses the docker-compose.yaml in the current working directory, it's the equivalent to `docker run`  

The `-d` option will detach from the terminal
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose up -d
Starting stickynotes-jb_db_1 ... done
Starting stickynotes-jb_php_1        ... done
Starting stickynotes-jb_phpmyadmin_1 ... done
```

##  <a name="build">docker-compose build</a> 
build an image from a docker-compose.yaml file in the current working directory

`docker-compose build `
see  [stickynotes](https://github.com/campbe13/docker-ecq2020/blob/master/stickynotes-jb/DOCKERCOMPOSERUN.md#docker-compose-build)  for complete runtime output
## docker-compose ps
show images on the localhost  for the yaml file in the current working directory

the difference between `docker ps` and this is that this shows only what is referenced in the local yaml file 
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose  ps
           Name                         Command              State              Ports
------------------------------------------------------------------------------------------------
stickynotes-jb_db_1           docker-entrypoint.sh --inn     Up      0.0.0.0:32769->3306/tcp,
                              ...                                    33060/tcp
stickynotes-jb_php_1          docker-php-entrypoint /bin     Up      0.0.0.0:8700->80/tcp
                              ...
stickynotes-jb_phpmyadmin_1   /docker-entrypoint.sh apac     Up      0.0.0.0:8701->80/tcp
                              ...
```
# <a name="exec">docker exec  / docker-compose exec</a>
Execute a command on the container.

n.b. for full info see `man docker exec`

Use the following to shell into a running container (must be runnign
`docker exec -it` *containername* ` sh` 
or 
`docker exec -it` *containername* ` bash`
Using the running container from the docker ps section **relaxed_shtern** we could 
`docker exec -it relaxed_shtern sh`
Note, as you see below, when you shell into a container you are root, \#,  and the commands available will be limited, for example this image does not have netstat / ss / net-tools installed.  They could be installed but I would do that just for testing.
Note below the logs are big because they map to the localhost
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker exec -ti stickynotes-jb_php_1 bash
root@027eb5165fcc:/var/www/html# ps aux
USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
root         1  0.0  0.0   2388   680 ?        Ss   17:03   0:00 /bin/sh -c apachectl -D  FOREGR
root         6  0.0  0.0   2388   680 ?        S    17:03   0:00 /bin/sh /usr/sbin/apachectl -D
root         8  0.0  0.6  83220 24888 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data     9  0.0  0.1  83244  7164 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data    10  0.0  0.1  83244  7164 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data    11  0.0  0.1  83244  7164 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data    12  0.0  0.1  83244  7164 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
www-data    13  0.0  0.1  83244  7164 ?        S    17:03   0:00 /usr/sbin/apache2 -D FOREGROUND
root        14  0.6  0.0   3984  3184 pts/0    Ss   17:19   0:00 bash
root        34  0.0  0.0   7640  2728 pts/0    R+   17:21   0:00 ps aux
root@027eb5165fcc:/var/www/html# df -h
Filesystem      Size  Used Avail Use% Mounted on
overlay         293G   15G  264G   6% /
tmpfs            64M     0   64M   0% /dev
tmpfs           1.9G     0  1.9G   0% /sys/fs/cgroup
/dev/sda1       293G   15G  264G   6% /var/log
shm              64M     0   64M   0% /dev/shm
tmpfs           1.9G     0  1.9G   0% /proc/asound
tmpfs           1.9G     0  1.9G   0% /proc/acpi
tmpfs           1.9G     0  1.9G   0% /proc/scsi
tmpfs           1.9G     0  1.9G   0% /sys/firmware
root@027eb5165fcc:/var/www/html# exit
```
## <a name="logs">docker-compose logs</a> 
Show the log files from a running containers.  You can specify only one of the containers if needed, default is all logs.
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose logs
Attaching to stickynotes-jb_php_1, stickynotes-jb_phpmyadmin_1, stickynotes-jb_db_1
db_1          | 2020-03-10 16:58:36+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10 16:58:36+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
db_1          | 2020-03-10 16:58:36+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10T16:58:37.409765Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-10T16:58:37.409984Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
db_1          | 2020-03-10T16:58:46.035304Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
db_1          | 2020-03-10T16:58:46.187206Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
db_1          | 2020-03-10T16:58:46.660118Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
db_1          | 2020-03-10T16:58:47.081469Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
db_1          | 2020-03-10 16:59:37+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10 16:59:37+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
db_1          | 2020-03-10 16:59:37+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10T16:59:38.021941Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-10T16:59:38.022255Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
db_1          | 2020-03-10T16:59:43.073366Z 0 [System] [MY-010229] [Server] Starting XA crash recovery...
db_1          | 2020-03-10T16:59:43.100357Z 0 [System] [MY-010232] [Server] XA crash recovery finished.
db_1          | 2020-03-10T16:59:43.871862Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
db_1          | 2020-03-10T16:59:43.935130Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
db_1          | 2020-03-10T16:59:44.163248Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
db_1          | 2020-03-10T16:59:44.524636Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
db_1          | 2020-03-10T17:02:30.984447Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.19)  MySQL Community Server - GPL.
db_1          | 2020-03-10 17:03:16+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10 17:03:16+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
db_1          | 2020-03-10 17:03:16+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-10T17:03:17.346656Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-10T17:03:17.346903Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
db_1          | 2020-03-10T17:03:23.261271Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
db_1          | 2020-03-10T17:03:23.326164Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
db_1          | 2020-03-10T17:03:23.570024Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
db_1          | 2020-03-10T17:03:23.724458Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
php_1         | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.3. Set the 'ServerName' directive globally to suppress this message
php_1         | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.4. Set the 'ServerName' directive globally to suppress this message
php_1         | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.4. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | phpMyAdmin not found in /var/www/html - copying now...
phpmyadmin_1  | Complete! phpMyAdmin has been successfully copied to /var/www/html
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.4. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.4. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | [Tue Mar 10 16:58:54.485623 2020] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.38 (Debian) PHP/7.4.1 configured -- resuming normal operations
phpmyadmin_1  | [Tue Mar 10 16:58:54.485743 2020] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
phpmyadmin_1  | [Tue Mar 10 16:59:27.787800 2020] [mpm_prefork:notice] [pid 1] AH00170: caught SIGWINCH, shutting down gracefully
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.3. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.3. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | [Tue Mar 10 16:59:43.429415 2020] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.38 (Debian) PHP/7.4.1 configured -- resuming normal operations
phpmyadmin_1  | [Tue Mar 10 16:59:43.429545 2020] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
phpmyadmin_1  | [Tue Mar 10 17:02:16.867178 2020] [mpm_prefork:notice] [pid 1] AH00170: caught SIGWINCH, shutting down gracefully
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.3. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 192.168.48.3. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | [Tue Mar 10 17:03:22.930259 2020] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.38 (Debian) PHP/7.4.1 configured -- resuming normal operations
phpmyadmin_1  | [Tue Mar 10 17:03:22.930370 2020] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'

```
## <a name="stop">docker-compose stop</a>
Stop the running containers 
To stop the container (The image is still there, you can start it again, it will not take as long as it does not have to download) 
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose  stop
Stopping stickynotes-jb_php_1        ... done
Stopping stickynotes-jb_phpmyadmin_1 ... done
Stopping stickynotes-jb_db_1         ... done
```

## <a name="images">docker-compose images</a>
show images on the localhost  for the yaml file in the current working directory

To see all images that are local, downloaded or created through Dockerfiles &/or compose yaml files use `docker images`.
I can run any of the below by name, they are downloaded so they run quickly.
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose images
         Container                 Repository          Tag       Image Id       Size
--------------------------------------------------------------------------------------
stickynotes-jb_db_1           mysql                   latest   c8ad2be69a22   465.4 MB
stickynotes-jb_php_1          stickynotes-jb_php      latest   522d19846ec0   427.9 MB
stickynotes-jb_phpmyadmin_1   phpmyadmin/phpmyadmin   latest   c24a75debb40   469.5 MB
```
## docker-compose information commands
Note docker-compose sits on top of docker commands and uses most of what we have seen for docker.
 version
```
tricia@acerubuntu1804:~$ docker-compose version
docker-compose version 1.25.4, build unknown
docker-py version: 4.2.0
CPython version: 2.7.17
OpenSSL version: OpenSSL 1.1.1  11 Sep 2018
```
 config
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose config
networks:
  backend: {}
  frontend: {}
services:
  db:
    command: --innodb_use_native_aio=0
    environment:
      MYSQL_DATABASE: assignment2
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: educate3
      MYSQL_USER: student
    image: mysql:latest
    networks:
      backend: null
    ports:
    - target: 3306
    volumes:
    - /home/tricia/ecq/docker-ecq2020/stickynotes-jb/dbsetup:/docker-entrypoint-initdb.d:rw
    - persistent:/var/lib/mysql:rw
  php:
    build:
      context: /home/tricia/ecq/docker-ecq2020/stickynotes-jb/php
    depends_on:
    - db
    environment:
      XYZ: '"this is an example"'
    networks:
      backend: null
      frontend: null
    ports:
    - published: 8700
      target: 80
    volumes:
    - /home/tricia/ecq/docker-ecq2020/stickynotes-jb/jeffstickyphp:/var/www/html:rw
    - /var/log:/var/log:rw
  phpmyadmin:
    depends_on:
    - db
    environment:
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: educate3
      MYSQL_USER: student
    image: phpmyadmin/phpmyadmin
    links:
    - db:db
    networks:
      backend: null
      frontend: null
    ports:
    - published: 8701
      target: 80
version: '3.7'
volumes:
  persistent: {}
```
 config --services
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/stickynotes-jb$ docker-compose config --services     
db
php
phpmyadmin
```
# TODO full list, add missing ^^ docker admin commands
```
 1280  docker-compose stop 
 1291  docker-compose logs 
 1336  docker-compose up -d 
 1347  docker-compose logs
 1349  docker-compose logs
 1351  docker-compose build db
 1380  docker-compose down 
 1381  docker-compose build
 1382  docker-compose up -d
 1398  docker-compose down
 1925  docker-compose rm
 1926  docker-compose system prune
 1927  docker-compose images
 1928  docker-compose port
 1930  docker-compose  network 
 1942  docker-compose down
 1943  docker-compose up -d 
 2105  docker-compose push 
```
