#!/bin/bash
# pmc
# 2020-02-03
# see Dockerfile
# using whalesay image install fortune, figlet 
# use cowsay when run

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

container=whalesay
read -p "hit enter to build $container"
sudo docker build -t $container .
read -p "hit enter to run $container"
sudo docker run $container 
