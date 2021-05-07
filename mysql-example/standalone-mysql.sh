#!/bin/bash
# 2020-03-10
# PMCampbell
# run a mysql container db (or a couple of dbs) 
# change rootpassword if you wish

if [[ $1 == "-h" ||  $1 == "--help"  ||  $1 == "help" ]] ; then
      echo $(basename $0) this script will launch 2 mysql containers 
      echo $(basename $0) one listens on the standard port of 3306
      echo $(basename $0) the other listens on the 3307
      echo to access the dbs  mysql -u root -p your.ip.add.ress
      exit 1
fi

secretpassword=secret-password

# docker run, some options
# --name   name the image
# -d  detach from the terminal, to see logs use docker logs command
# -e  set environment variables, for all see https://hub.docker.com/_/mysql/
# -p  forward port(s) from the container to the host -p host:container 
# mysql:latest    the base image from docker hub

# first instance of db
docker run --name mysql-container1 -d -e MYSQL_ROOT_PASSWORD=$secretpassword -p 3306:3306 mysql:latest

# second instance of db note port 3307, cannot bind to same port on host
# but the db container itself is isolated so 3306 on container
docker run --name mysql-container2 -d -e MYSQL_ROOT_PASSWORD=$secretpassword -p 3307:3306 mysql:latest
