#!/bin/bash
# pmc
# 2020-02-12
# see Dockerfile

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

container=tricia/shakespearejm

# build the container image
# run the container
read -p "hit enter to build $container"
docker build -t $container .

# run the container
read -p "hit enter to run $container"

# port forward container 80 to host 8080
# -p hostport:containerport  
# detach, run in bg releases console 
# -d 

# stop last runtime
docker stop flasktest 2> /dev/null
docker run --name shakespeare-jm -d -p 8080:80 $container 

# show port bindings 
# docker inspect $container
# show running containers
docker ps
