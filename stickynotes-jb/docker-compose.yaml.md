# docker-compose.yaml
docker-compose sits ontop of docker, used to manage multi container apps
this one has three containers, called services in the yaml, *php* which is the app+php+apache, *db* which runs mysql and 
 *phpmyadmin* which runs phpmyadmin

* `docker-compose` default file `docker-compose.yaml`
* `docker` default file `Dockerfile`

 (see https://docs.docker.com/compose/compose-file/) 
 compose file format version 
##  the docker-compose version with which the file corresponds
`version: "3.7"`

## services: 
all services (containers) are indented under this
## php service name (host name on network)	
all containers configs are indented under this, the name used is pingable on the
container network.  For example to use the `db` container as the host from the php container
configure `db` as the `server_name`. see [config.ini](todo) Will resolve to the correct ip address.
```
services:
  php:
```
#   build: location of the Dockerfile
only needed if we are building our own in this case the app is deployed on a container
```
    build: ./php
#   volumes: mapping local to container
volumes is a complex subject see the ^ compose file reference, here we are 
"developing" the app so the app is run from the localhost `./jeffstickyphp/:/var/www/html`
and we have the log files written to the localhost `/var/log:/var/log` 
```
    volumes: 
        - ./jeffstickyphp/:/var/www/html
        - /var/log:/var/log
``
#  networks:  configure the container, internal network
networks are  also a complex subject, avoid links but you may see them 
*  legacy feature https://docs.docker.com/network/links/
#  should use https://docs.docker.com/network/bridge/
```
    networks:
      - backend
      - frontend
```
##  port forward 80 from container to 8700 host
If you are using single containers this is done in the run statement 
yaml sits on top of docker, most docker commands with docker-compose 
```
    ports:
        - '8700:80'
```
##   depends_on internal dependecies for order of ops
means anything under here must be built before this service
```
    depends_on:
        - db

## db service name (host name on network)	
all containers configs are indented under this, the name used is pingable on the
container network.  For example to use the `db` container as the host from the php container

no build needed, using pre built image
## image  the image to pull from the registry (docker hub  in this case)
This is the image, you can find environment vars & other runtime information here
* https://hub.docker.com/_/mysql/

```
  db:
    image: mysql:latest
```

## command  the command(s) to run on container launch 
https://docs.docker.com/compose/compose-file/#command
this one is needed due to an error in the v8+ see the yaml for info
``` 
    command: --innodb_use_native_aio=0
```
## envirolnment variables for use by the conainer
https://docs.docker.com/compose/compose-file/#environment
in this case we are using a base image and setting it up for our app, so the d
```
    environment:
     MYSQL_DATABASE: assignment2
     MYSQL_USER: student
     MYSQL_PASSWORD: secret
     MYSQL_ROOT_PASSWORD: educate3
#  networks:  configure the container, internal network
networks are  also a complex subject, avoid links but you may see them 
*  legacy feature https://docs.docker.com/network/links/
#  should use https://docs.docker.com/network/bridge/
```
    networks:
      - backend
```

#   volumes: mapping local to container
volumes is a complex subject see the ^ compose file reference, here we are 
using a docker startup directory, everything in here that is a script (.sh or .sql) will be run on startup/engry to the container  
 ` ./dbsetup:/docker-entrypoint-initdb.d`
I am uncertaine whether it is better to copy the files over, or to mount a volume, need to understand volumes better

we also have the database o persistent storrage, containers are ephemeral so if we want data to persist we must do this
`persistent:/var/lib/mysql`
```
    volumes:
      - ./dbsetup:/docker-entrypoint-initdb.d
      - persistent:/var/lib/mysql
```
##  port forward 3306 from container to 3600 host
Not sure if I need this, I will test it without, only need the port internally to the container network

If you are using single containers this is done in the run statement 
yaml sits on top of docker, most docker commands with docker-compose 
```
    ports:
        - "3306:3306"
```
# phpmyadmin 
# manage db for testing only
# no build/Dockerfile needed 
# using pre built image
  phpmyadmin:
    links:
      - db:db
    image: phpmyadmin/phpmyadmin
    environment:
     MYSQL_USER: student
     MYSQL_PASSWORD: secret
     MYSQL_ROOT_PASSWORD: educate3
    networks:
     - backend
     - frontend
    ports:
        - "8701:80"
    depends_on:
        - db
volumes:
    persistent:
networks:
  frontend:
  backend:
## docker-compose.yaml yaml only, no comments
```
version: "3.7"

services:
  php:
    build: ./php
    volumes: 
        - ./jeffstickyphp/:/var/www/html
        - /var/log:/var/log
    networks:
      - backend
      - frontend
    ports:
        - '8700:80'
    environment:
        - XYZ="this is an example"
    depends_on:
        - db
  db:
    image: mysql:latest
    command: --innodb_use_native_aio=0

    environment:
     MYSQL_DATABASE: assignment2
     MYSQL_USER: student
     MYSQL_PASSWORD: secret
     MYSQL_ROOT_PASSWORD: educate3
    networks:
      - backend
    volumes:
      - ./dbsetup:/docker-entrypoint-initdb.d
      - persistent:/var/lib/mysql
    ports:
        - "3306:3306"
  phpmyadmin:
    links:
      - db:db
    image: phpmyadmin/phpmyadmin
    environment:
     MYSQL_USER: student
     MYSQL_PASSWORD: secret
     MYSQL_ROOT_PASSWORD: educate3
    networks:
     - backend
     - frontend
    ports:
        - "8701:80"
    depends_on:
        - db
volumes:
    persistent:
networks:
  frontend:
  backend:
```
