#!/bin/bash
# pmc
# 2020-02-12
# see Dockerfile

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

container=tricia/flaskpoc
read -p "hit enter to build $container"
docker build -t $container .
read -p "hit enter to run $container"
# running flask, binds to port 5000
# port forward container 5000 to host 8080
# -p hostport:containerport  
# detach, run in bg releases console 
# -d 

# stop last runtime
docker stop flasktest
#docker run --name flasktest -d -p 172.17.0.4:5000:8080 $container 
docker run --name flasktest -d -p 5000:5000 $container 
#docker run -d -p 5000:8080 $container 
#docker run  -d -p 192.168.0.117:8080:5000 $container 

# show port bindings 
# docker inspect $container
# show running containers
docker ps
