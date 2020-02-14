#!/bin/bash
# pmc
# 2020-02-12
# see Dockerfile

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

# build the container image
# run the container
if [[ ! -e Dockerfile ]] ; then
   echo $(basename $0) Dockerfile missing, cannot build quitting
   exit 4
fi

container=tricia/flaskpoc

read -p "hit enter to build $container"
docker build -t $container .

# run the container
read -p "hit enter to run $container"

# stop last runtime
docker stop flasktest 2> /dev/null

# running flask, binds to port 5000
# port forward container 5000 to host 5080
# -p hostport:containerport  
# detach, run in bg releases console 
# -d 
docker run --name flasktest -d -p 5000:5000 $container 

# show port bindings 
# docker inspect $container
# show running containers
docker ps
